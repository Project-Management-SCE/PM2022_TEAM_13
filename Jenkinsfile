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
node {
    stage('Cleanup') {
        sh 'rm -rf ./*'
    }
    stage('Fetch from GitHub') {
         git branch: "main", url: "git@github.com:Project-Management-SCE/PM2022_TEAM_13.git", credentialsId: "jenkinskey"
    }
    stage('Get Composer') {
        sh 'wget -q http://getcomposer.org/download/1.2.1/composer.phar'
    }
    stage('Build') {
        dir('ulid') {
            sh 'php ../composer.phar install'
        }
    }
    stage('Run Unit Tests in PHP') {
        dir('ulid') {
            sh 'php vendor/bin/phpunit'
        }
    }
}


