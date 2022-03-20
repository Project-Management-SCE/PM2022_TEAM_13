pipeline {
   
        stage('Clone repo') {
        git branch: "main", url: "git@github.com:Project-Management-SCE/PM2022_TEAM_13.git", credentialsId: "jenkinskey"
    }
    
    stage('Build app') {
        docker.image('php:7.2').inside('-v /var/run/docker.sock:/var/run/docker.sock') {
            sh "php init --env=Development"
        }
    }
}


