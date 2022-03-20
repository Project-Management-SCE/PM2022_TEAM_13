pipeline {
    agent any 
    stages {
        stage('Stage 1') {
            steps {
                echo 'Hello world!' 
                sh 'composer install'
                 sh 'vendor/bin/phpunit ./tests'
            }
        }
        
    }
}



