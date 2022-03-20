pipeline {
    agent any 
    stages {
        stage('Stage 1') {
            steps {
                echo 'Hello world!' 
            }
        }
         stage('Composer Install') {
        sh 'composer install'
         }
          stage("PHPUnit") {
        sh 'vendor/phpunit/phpunit/phpunit --bootstrap build/bootstrap.php --configuration phpunit-coverage.xml'
            }
        
    }
}



