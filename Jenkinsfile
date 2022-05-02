node {
  stage("Main") {

     git branch: "main", url: "git@github.com:Project-Management-SCE/PM2022_TEAM_13.git", credentialsId: "jenkins-key2"

    docker.image('php:7.4.1').inside("-e COMPOSER_HOME=/tmp/jenkins-workspace") {

      stage("Prepare folders") {
        sh "mkdir /tmp/jenkins-workspace"
      }

      stage("Get Composer") {
        sh "php -r \"copy('https://getcomposer.org/installer', 'composer-setup.php');\""
        sh "php composer-setup.php"
      }

      stage("Install dependencies") {
       sh "yum install zip unzip php-zip"
        sh "php composer.phar install"
       
      }

      stage("Run tests") {
        sh "vendor/bin/phpunit tests/ValidatePassTest.php"
      }

   }

  }

  // Clean up workspace
  step([$class: 'WsCleanup'])

}
