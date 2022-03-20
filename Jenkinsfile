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
    agent {
        docker 'app/php:7.1-dev-jenkins'
    }
   
    stages {
        stage('Install dependencies') {
            environment {
                COMPOSER_HOME = '/var/jenkins_home/.composer'
            }
            steps {
                sh 'composer install --prefer-dist --no-progress --no-suggest --no-interaction --no-scripts'
            }
        }
        stage('Tests') {
            parallel {
                stage('PHPUnit') {
                    environment {
                        SYMFONY_PHPUNIT_DIR = 'vendor/bin/.phpunit'
                    }
                    steps {
                        sh 'phpdbg -d memory_limit=512M -qrr bin/phpunit'
                        archiveArtifacts 'clover.xml'
                        archiveArtifacts 'report.xml'
                        junit 'report.xml'
                    }
                }
                
            }
