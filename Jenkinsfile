node {
    
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
    stage('PHPUnit Tests') {
            steps {
                catchError(buildResult: 'FAILURE', stageResult: 'FAILURE') {
                    sh '''
                        cd symfony
                        cp phpunit.xml.dist phpunit.xml
                        ./bin/console cache:warmup --env=test
                        ./vendor/bin/phpunit\
                            --coverage-clover '../reports/coverage/coverage.xml'\
                            --coverage-html '../reports/coverage'\
                            --log-junit '../reports/unitreport.xml'
                    '''
                }

                junit 'reports/unitreport.xml'

                publishHTML([
                    allowMissing: true,
                    alwaysLinkToLastBuild: false,
                    keepAll: true,
                    reportDir: 'reports/coverage',
                    reportFiles: 'index.html',
                    reportName: 'PHPUnit Test Coverage Report'
                ])
            }
        }
    }
      
    

