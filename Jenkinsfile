pipeline {
  agent any
  stages {
    stage('Checkout') {
      steps {
        git(url: 'git@github.com:Project-Management-SCE/PM2022_TEAM_13.git', branch: 'main',credentialsId: "jenkinskey")
      }
    }

    stage('Test') {
      parallel {
        stage('PHP 7.4') {
          agent {
            docker {
              image 'allebb/phptestrunner-74:latest'
              args '-u root:sudo'
            }

          }
          steps {
            echo 'Running PHP 7.4 tests...'
            sh 'php -v'
            echo 'Installing Composer'
            sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer'
            echo 'Installing project composer dependencies...'
            sh 'cd $WORKSPACE && composer install --no-progress'
            echo 'Running PHPUnit tests...'
            sh 'cd src ;./vendor/bin/phpunit --log-junit=storage/logs/unitreport'
            junit 'report/*.xml'
          }
        }

      }
    }

    stage('Release') {
      steps {
        echo 'Ready to release etc.'
      }
    }

  }
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

