node {
    
   stage('Clone repo') {
        git branch: "main", url: "git@github.com:Project-Management-SCE/PM2022_TEAM_13.git", credentialsId: "jenkinskey"
    }
    stage('Build app') {
       
            docker.image('composer').inside('-v /var/run/docker.sock:/var/run/docker.sock') {
           
            sh "composer install --optimize-autoloader --ignore-platform-reqs"
            
             
         }
        
    
    }
    stage('test') {
         
       
            sh 'vendor/bin/phpunit tests/ValidatePassTest.php'
        
      
        }
    
      
    
}


