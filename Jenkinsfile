node {
  stage("Main") {

     git branch: "main", url: "git@github.com:Project-Management-SCE/PM2022_TEAM_13.git", credentialsId: "jenkinskey"

    docker.image('bitnami/php-fpm:5.3.3').inside("-e COMPOSER_HOME=/tmp/jenkins-workspace") {

      stage("Prepare folders") {
        sh "mkdir /tmp/jenkins-workspace"
      }

      stage("Get Composer") {
        sh "php -r \"copy('https://getcomposer.org/installer', 'composer-setup.php');\""
        sh "php composer-setup.php"
      }

      stage("Install dependencies") {
        sh "php composer.phar install"
      }

      stage("Run tests") {
        sh "vendor/bin/phpunit"
      }

   }

  }

  // Clean up workspace
  step([$class: 'WsCleanup'])

}

/*node {
    
   stage('Clone repo') {
        git branch: "main", url: "git@github.com:Project-Management-SCE/PM2022_TEAM_13.git", credentialsId: "jenkinskey"
    }
    stage('Build app') {
        docker.image('php:7.4.1').inside('-v /var/run/docker.sock:/var/run/docker.sock') {
           sh 'php --version'
        }
        
        docker.image('composer').inside('-v /var/run/docker.sock:/var/run/docker.sock') {
             sh "composer config -g github-oauth.github.com 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"
            sh "composer install --optimize-autoloader --ignore-platform-reqs"
            
        }
    
    }
    stage('test') {
         
        sh "ls -al"
        sh 'cd src ;./vendor/bin/phpunit --log-junit=storage/logs/unitreport'
        echo 'Testing'
      
        }
    stage('Deploy') {
     
        sh "/var/lib/jenkins/shells/deploy.php"
        echo 'Deployed'
      
    
    }
      
    
}*/
