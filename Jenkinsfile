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
         
        sh './vendor/phpunit/phpunit/phpunit --configuration phpunit-no-coverage-unit-only.xml --no-coverage --log-junit build/logs/junit.xml'
      
        }
    
      
    
}
*/


pipeline {
  agent any

  options {
    disableConcurrentBuilds()
    timeout(time: 30, unit: 'MINUTES')
  }

  environment {
    PATH = "vendor/bin:/var/lib/jenkins/.composer/vendor/bin:$PATH"
  }

  stages {
    stage('prepare') {
      steps {
        slackSend channel: '#<channel>',
                  message: "Build started: ${currentBuild.fullDisplayName} (<${env.RUN_DISPLAY_URL}|Open>)"

        sh 'mkdir -p build/api build/code-browser build/coverage build/logs build/pdepend} || true'
        sh "composer install"
      }
    } // stage prepare

    stage('analysis') {
      steps {
        parallel (
          lint: {
            sh 'parallel-lint -s <src>'
          },
          phpmd: {
            sh 'phpmd <src> xml build/phpmd.xml --reportfile build/logs/pmd.xml --suffixes php --ignore-violations-on-exit'
          },
          phpcs: {
            sh 'phpcs --report=checkstyle --report-file=build/logs/phpcs-checkstyle.xml --standard=phpcs.xml --extensions=php --runtime-set ignore_errors_on_exit 1 --runtime-set ignore_warnings_on_exit 1 <src>'
          },
          phpcpd: {
            sh 'phpcpd --log-pmd build/logs/pmd-cpd.xml <src> || true'
          },
          pdepend: {
            sh 'pdepend --jdepend-xml=build/logs/jdepend.xml --jdepend-chart=build/pdepend/dependencies.svg --overview-pyramid=build/pdepend/overview-pyramid.svg <src> || true'
          }
        )
      }

      post {
       success {
         pmd canComputeNew: false, defaultEncoding: '', healthy: '70', pattern: 'build/logs/pmd.xml', unHealthy: '999'
         checkstyle canComputeNew: false, defaultEncoding: '', healthy: '100', pattern: 'build/logs/*-checkstyle.xml', unHealthy: '999'
         dry canComputeNew: false, defaultEncoding: '', healthy: '', pattern: 'build/logs/pmd-cpd.xml', unHealthy: ''
       }
     }
   } // stage analysis

    stage('test') {
      steps {
        sh "phpunit -c phpunit.xml.dist --coverage-html build/coverage --coverage-clover build/logs/clover.xml --coverage-crap4j build/logs/crap4j.xml --log-junit build/logs/junit.xml"
      }

      post {
        success {
          junit 'build/logs/junit.xml'
          publishHTML(allowMissing: false, alwaysLinkToLastBuild: false, keepAll: true, reportDir: 'build/coverage', reportFiles: 'index.html', reportName: 'PHP code coverage', reportTitles: 'Code Coverage')
        }
      }
    } // stage test
  }

  post {
    success {
      slackSend channel: '#<channel>',
                color: 'good',
                message: "${currentBuild.fullDisplayName} completed successfully after ${currentBuild.durationString}. (<${env.RUN_DISPLAY_URL}|Open>)"
    }
    failure {
      slackSend channel: '#<channel>',
                color: 'danger',
                message: "@channel ${currentBuild.fullDisplayName} failed after ${currentBuild.durationString}. (<${env.RUN_DISPLAY_URL}|Open>)"
    }
    unstable {
      slackSend channel: '#<channel>',
                color: 'warning',
                message: "${currentBuild.fullDisplayName} passed after ${currentBuild.durationString}, but is unstable. (<${env.RUN_DISPLAY_URL}|Open>)"
    }
    aborted {
      slackSend channel: '#<channel>',
                message: "Build aborted: ${currentBuild.fullDisplayName} (<${env.RUN_DISPLAY_URL}|Open>)"
    }
  }
}
