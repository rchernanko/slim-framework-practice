<?php
namespace BusuuTest\EntityRepository;

use Slim\Container;
use Slim\Http\Request;

class ExerciseRepository implements RepositoryInterface

//create an abstract class that implements repository interface
//give that a constructor
//then going forward, every time i add a new repository, it should have access to the container and values

{
    private $container;

    /**
     * ExerciseRepository constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function findAll()
    {
        //TODO I should probably make this a prepared statement too
        //TODO make more robust...what if the query fails for example?

        $query = "select * from exercises";
        $result = $this->container['db']->query($query);

        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function find($exerciseId)
    {
        //TODO make more robust...what if the query fails for example? What if there is no exercise data...?
        //TODO I should probably make this a prepared statement too

        $query = "select * from exercises where exerciseId = $exerciseId";
        $result = $this->container['db']->query($query);

        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function delete($exerciseId)
    {
        $query = "delete from exercises where exerciseId = $exerciseId";
        $this->container['db']->query($query);

        //TODO what if the above query fails to execute? Or what if that exercise doesn't even exist? Make more robust

        //TODO handle this better
        //return result...

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

    public function save(Request $request)
    {
        //TODO what if the above query fails to execute? Make more robust

        $query = "INSERT INTO exercises (author, exerciseText) VALUES (?,?)";

        $stmt = $this->container['db']->prepare($query);

        $author = $request->getParsedBody()['author'];
        $exerciseText = $request->getParsedBody()['exerciseText'];

        $stmt->bind_param("ss", $author, $exerciseText);

        $stmt->execute();

        //TODO handle this better
        //return result...
    }

    public function update($exerciseId, Request $request)
    {
        //TODO what if the above query fails to execute? Make more robust

        $query = "UPDATE exercises SET author = ?, exerciseText = ? WHERE exercises.exerciseId = $exerciseId";

        $stmt = $this->container['db']->prepare($query);

        $stmt->bind_param("ss", $author, $exerciseText);

        $author = $request->getParsedBody()['author'];
        $exerciseText = $request->getParsedBody()['exerciseText'];

        $stmt->execute();

        //TODO handle this better
        //return result...
    }
}