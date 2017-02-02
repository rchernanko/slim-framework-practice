<?php
namespace BusuuTest\EntityRepository;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class ExerciseRepository implements RepositoryInterface
{
    public function findAll(Response $response, Container $container)
    {
        $mysqli = $container['db']; //TODO how can I reduce duplication of getting the container on every function...?

        $query = "select * from exercises";
        $result = $mysqli->query($query);

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        if (isset($data)) {
            return $response->withJson($data, 200);
        }

        return $response->withJson(['msg' => 'No exercises found'], 404);

        //TODO make more robust...what if the query fails for example?
        //TODO I should probably make this a prepared statement too
    }

    public function find($exerciseId, Response $response, Container $container)
    {
        $mysqli = $container['db'];

        $query = "select * from exercises where exerciseId = $exerciseId";
        $result = $mysqli->query($query);

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        if (isset($data)) {
            return $response->withJson($data, 200);
        }

        return $response->withJson(['msg' => 'No exercises found'], 404);

        //TODO make more robust...what if the query fails for example?
        //TODO I should probably make this a prepared statement too
    }

    public function delete($exerciseId, Response $response)
    {
        $query = "delete from exercises where exerciseId = $exerciseId";
        $this->container['db']->query($query);

        return $response->withJson("Exercise with id $exerciseId has been deleted", 200);
        //TODO what if the above query fails to execute? Or what if that exercise doesn't even exist? Make more robust
        //TODO something like the below?

        /*
         *
         * $query = mysqli_query($con, "SELECT * FROM emails WHERE email='".$email."'");

            if(mysqli_num_rows($query) > 0){

            echo "email already exists";
                }else{
                  // do something
                  if (!mysqli_query($con,$query))
                  {
                 die('Error: ' . mysqli_error($con));
          }
            }

         */
    }

    public function save(Request $request, Response $response)
    {
        $query = "INSERT INTO exercises (author, exerciseText) VALUES (?,?)";

        $stmt = $this->container['db']->prepare($query);

        $stmt->bind_param("ss", $author, $exerciseText);

        $author = $request->getParsedBody()['author'];
        $exerciseText = $request->getParsedBody()['exerciseText'];

        $stmt->execute();

        return $response->withJson("Exercise has been created", 200);
        //TODO what if the above query fails to execute? Make more robust
    }

    public function update(Request $request, Response $response)
    {
        $id = $request->getAttribute('id');

        $query = "UPDATE exercises SET author = ?, exerciseText = ? WHERE exercises.exerciseId = $id";

        $stmt = $this->container['db']->prepare($query);

        $stmt->bind_param("ss", $author, $exerciseText);

        $author = $request->getParsedBody()['author'];
        $exerciseText = $request->getParsedBody()['exerciseText'];

        $stmt->execute();

        return $response->withJson("Exercise text within $id has been updated", 200);
        //TODO what if the above query fails to execute? Make more robust
    }
}