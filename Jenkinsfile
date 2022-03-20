pipeline {
    agent { docker { image 'php:8.1.0-alpine' } } 
    stages {
        stage('Stage 1') {
            steps {
                echo 'Hello world!' 
                 sh 'php --version'
                 
                sh 'vendor/bin/phpunit tests/ValidatePassTest.php'
            }
        }
        
    }
}



