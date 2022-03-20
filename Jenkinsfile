pipeline {
    agent { docker { image 'php:7.4.1-alpine' } } 
    stages {
        stage('Stage 1') {
            steps {
                echo 'Hello world!' 
                 sh 'php --version'
                 
                
            }
        }
        
    }
}



