pipeline {
    agent any 
    stages {
        stage('Stage 1') {
            steps {
                echo 'Hello world!' 
                sh 'composer install'
                 sh 'vendor/phpunit/phpunit/phpunit --bootstrap build/bootstrap.php --configuration phpunit-coverage.xml'
            }
        }
        
    }
}



