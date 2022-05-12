node {
  stage("Main") {

     git branch: "main", url: "git@github.com:Project-Management-SCE/PM2022_TEAM_13.git", credentialsId: "jenkins-key2"

    docker.image('php:7.4.1-alpine').inside("-e COMPOSER_HOME=/tmp/jenkins-workspace") {

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
        sh "vendor/bin/phpunit tests/ValidatePassTest.php"
      }
      
      stage("deployment"){
      sh "ssh root@46.101.154.62"
      }

   }

  }

  // Clean up workspace
  step([$class: 'WsCleanup'])

}
