<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/exercises', function (Request $request, Response $response) use ($app) {

    /*
     * Prior to me getting injecting the db connection as part of DIC container, I wrote:
     * global $mySqli
     *
     * Vito said that he will slap me if he ever sees the use of global in my php code...
     * Instead it's much better practice to use Dependency Injections and make things available globally that way
     */

    $container = $app->getContainer();
    $mysqli = $container['db'];

    $query = "select * from exercises";
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    if (isset($data)) {
        return $response->withJson($data);
        //TODO add a status code too
    }

    return $response->withJson(['msg' => 'No exercises found'], 404);
});

$app->get('/exercises/{id}', function (Request $request, Response $response) use ($app) {

    $container = $app->getContainer();
    $mysqli = $container['db'];

    $id = $request->getAttribute('id');

    $query = "select * from exercises where exerciseId = $id";
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    if (isset($data)) {
        return $response->withJson($data);
        //TODO add a status code too
    }

    return $response->withJson(['msg' => 'No exercises found'], 404);
});

$app->delete('/exercises/{id}', function (Request $request, Response $response) use ($app) {

    $container = $app->getContainer();
    $mysqli = $container['db'];

    $id = $request->getAttribute('id');
    $query = "delete from exercises where exerciseId = $id";
    $mysqli->query($query);

    //TODO what if the above query fails to execute? Or what if that exercise doesn't even exist?

    $response->withJson("Exercise with id $id has been deleted");
    //TODO add a status code too


    //TODO add something like the below in

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
});

$app->post('/exercises', function (Request $request, Response $response) use ($app) {

    $container = $app->getContainer();
    $mysqli = $container['db'];

    $query = "INSERT INTO exercises (exerciseId, author, exerciseText) VALUES (?,?,?)";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param("iss", $exerciseId, $author, $exerciseText);

    $exerciseId = $request->getParsedBody()['exerciseId'];
    $author = $request->getParsedBody()['author'];
    $exerciseText = $request->getParsedBody()['exerciseText'];

    $stmt->execute();

    $response->withJson("Exercise $exerciseId has been created");

    //TODO check that the stmt was successful

});

$app->put('/exercises/{id}', function (Request $request, Response $response) use ($app) {

    $container = $app->getContainer();
    $mysqli = $container['db'];

    $id = $request->getAttribute('id');
    $exerciseText = $request->getParsedBody()['exerciseText'];

    $query = "update exercises set $exerciseText where exerciseId = $id";

    $mysqli->query($query);

    //TODO how to check the query ran successfully...

    //TODO get working with a prepared statement as per in slim-basic-project

    $response->withJson("Exercise text within $id has been updated");

});

//next step. contintue with SQL course in udemy. learn a little more about prepared statements
//start to build above in mvc, using the controller etc - with dependency injection

//build out a little further e.g. find specific exercise
//then start to read through ORM

/**
 * Create here the voting endpoint
 */
