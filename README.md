# Slim Framework Practice

Uses in built php web server

### Dependencies

* PHP - I am using 7.1.1
* Composer (https://getcomposer.org/)

### To launch:

1) Download dependencies with composer:

```sh
$ composer install
```

2) To run the php linter and then launch the web server:

```sh
$ composer start
```

### Example endpoint

* http://localhost:8080/exercises (GET)
* http://localhost:8080/index_test.php/exercises (GET, TestExerciseDatabase)
* http://localhost:8080/exercises/123 (GET)
* http://localhost:8080/index_test.php/exercises/123 (GET, TestExerciseDatabase)


### Tests

This framework uses Codeception.

Assuming you've installed Codeception globally, you can run the tests as so:

```sh
$ codecept run --html
```

The above will run the tests against the TestExerciseDatabase (see the index_test.php and config_test.php files).

### Test reports

After the tests run, an html report can be found in the following directory:

```sh
tests/_output/
```