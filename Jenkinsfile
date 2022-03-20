pipeline {
    agent any
    // agent { docker 'php' }

    environment {
        // Set "http_proxy" and other global environment variables in ~
        // ~ https://myjenkins.example.org/configure#!-Environment-variables
        MY_ENV = 'true'
    }

    stages {
        stage('Prepare') {
            steps {
                sh 'printenv'
                // unarchive mapping: [ 'composer.phar': 'composer.phar' ]
                sh 'curl -m30 -sS https://getcomposer.org/installer | php'
                sh 'php --version'
                sh 'php composer.phar --version'
                sh 'node --version'
                sh 'npm --version'
                sh 'ls -alh'
            }
        }
        stage('Build') {
            steps {
                echo 'Building..'
                sh 'php composer.phar update'  // Safer to 'update'?
                sh 'php composer.phar npm-install'
            }
        }
        stage('Test') {
            steps {
                echo 'Testing..'
                sh 'php composer.phar test'
            }
        }
    }

    post {
        always {
            echo 'Always ~ Clean'
            archive includes: 'composer.phar'
            sh 'ls -alh'
            sh 'rm -rf composer.lock'  // OR, 'rm -rf .' ??
            sh 'rm -rf vendor'
            // deleteDir() /* clean up our workspace */
        }
        success {
            echo 'I succeeeded!'
        }
        failure {
            echo 'I failed :('
            mail to: 'nfreear@yahoo.co.uk',
                subject: "Failed Pipeline: ${currentBuild.fullDisplayName}",
                body: "Something is wrong with ${env.BUILD_URL}"
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
        sh './vendor/bin/phpunit --log-junit=storage/logs/unitreport'
        echo 'Testing'
      
        }
    stage('Deploy') {
     
        sh "/var/lib/jenkins/shells/deploy.php"
        echo 'Deployed'
      
    
    }
      
    
}*/

