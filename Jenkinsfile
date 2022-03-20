pipeline {
    agent { docker { image 'php:7.4.1-alpine' } } 
    stages {
        stage('Stage 1') {
            steps {
                echo 'Hello world!' 
                 sh 'php --version'
             
                
            }
        }
        stage('Clone repo') {
        git branch: "main", url: "git@github.com:Project-Management-SCE/PM2022_TEAM_13.git", credentialsId: "jenkinskey"
    }
    
    stage('Build app') {
        docker.image('php:7.2').inside('-v /var/run/docker.sock:/var/run/docker.sock') {
            sh "php init --env=Development"
        }
    }
}


