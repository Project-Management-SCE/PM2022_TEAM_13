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
*/pipeline {
  agent any
  
  stages {
    stage('Checkout') {
      steps {
        checkout scm
        
        sh 'rm -rf build/{logs,pdepend}'
        
        sh 'mkdir -p build/{logs,pdepend}'
        
        sh '/usr/local/bin/composer install'
      }
    }
    
    stage('Code analysis') {
      steps {
        parallel (
          lint: {
            sh './vendor/bin/parallel-lint -s --exclude vendor/ .'
          },
          phpmd: {
            sh '/usr/bin/phpmd public_html xml build/phpmd.xml --reportfile build/logs/pmd.xml --suffixes php --ignore-violations-on-exit'
          },
          phpcs: {
            sh '/usr/bin/phpcs --report=checkstyle --report-file=build/logs/checkstyle.xml --standard=build/phpcs.xml --extensions=php --runtime-set ignore_errors_on_exit 1 --runtime-set ignore_warnings_on_exit 1 public_html tests'
          }
          
        )
      }
      
      post {
        success {
          step(
            [
              $class: 'PmdPublisher',
              canComputeNew: false,
              defaultEncoding: '',
              pattern: 'build/logs/pmd.xml',
              healthy: '70',
              unHealthy: '999'
            ]
          )
          step(
            [
              $class: 'CheckStylePublisher',
              canComputeNew: false,
              defaultEncoding: '',
              healthy: '100',
              pattern: 'build/logs/checkstyle.xml',
              unHealthy: '999'
            ]
          )
        }
      }
    }
  
    stage('Unit tests') {
      steps {
        sh './vendor/phpunit/phpunit/phpunit --configuration phpunit-no-coverage-unit-only.xml --no-coverage --log-junit build/logs/junit.xml'
      }
      
      post {
        success {
          step(
            [
              $class: 'XUnitBuilder',
              testTimeMargin: '3000',
              thresholdMode: 1,
              thresholds: [[
                $class: 'FailedThreshold',
                failureNewThreshold: '',
                failureThreshold: '',
                unstableNewThreshold: '',
                unstableThreshold: ''
              ],
              [
                $class: 'SkippedThreshold',
                failureNewThreshold: '',
                failureThreshold: '',
                unstableNewThreshold: '',
                unstableThreshold: ''
              ]],
              tools: [[
                $class: 'PHPUnitJunitHudsonTestType',
                deleteOutputFiles: true,
                failIfNotNew: true,
                pattern: 'build/logs/junit.xml',
                skipNoTestFiles: false,
                stopProcessingIfError: true
              ]]
            ]
          )
        }
      }
    }
  }
  
  post {
    success {
      slackSend(channel: '#deploy', color: 'good', message: "${env.JOB_BASE_NAME} - #${env.BUILD_ID} Success after ${currentBuild.durationString.replaceAll(' and counting', '')} (<${env.BUILD_URL}|Open>)")
    }
    failure {
      slackSend(channel: '#deploy', color: 'danger', message: "${env.JOB_BASE_NAME} - #${env.BUILD_ID} Failure after ${currentBuild.durationString.replaceAll(' and counting', '')} (<${env.BUILD_URL}|Open>)")
    }
  }
}
