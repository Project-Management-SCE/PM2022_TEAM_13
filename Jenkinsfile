pipeline {
  agent any
  stages {
    stage('Build') {
      agent any
      steps {
        sh 'docker-compose up -d'
        sh 'docker exec app_name composer install'
      }
    }    
    stage('PHP CS Fixer') {
      steps {
        sh 'php-cs-fixer fix --dry-run --no-interaction --diff -vvv src/'
      }
    }
    stage('Test') {
      steps {
        sh 'docker exec app_name php ./bin/phpunit --coverage-clover=\'reports/coverage/coverage.xml\' --coverage-html=\'reports/coverage\''
      }
    }
    stage('Coverage') {
      steps {
        step([$class: 'CloverPublisher'undefined cloverReportDir: '/reports/coverage'undefined cloverReportFileName: 'coverage.xml'])
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
         
       
            sh 'vendor/bin/phpunit tests/ValidatePassTest.php'
        
      
        }
    
      
    
}
*/

