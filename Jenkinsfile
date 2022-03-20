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


stage("Setup Project") {
    node() {
       sh "ls -lah"
       // clean out all files within this workspace
       deleteDir()

       sh "ls -lah"

       // Check out our repository
        git branch: "main", url: "git@github.com:Project-Management-SCE/PM2022_TEAM_13.git", credentialsId: "jenkinskey"

       // Composer install
       sh "composer install --prefer-dist --optimize-autoloader"

       // Stash our whole project files for later use
       stash "project_files"
    }
}

stage("Tests [Unit]") {

    parallel (
       /*
        because we're working in parallel here, we won't necessarily have the files we need for each parallel node
        we'll unstash them in each node to make sure we have the files we require
       */
       phpunit: {
          node {
             unstash "project_files"
             sh "bin/phpunit"
          }
       },
       phpspec: {
          node {
             unstash "project_files"
             sh "bin/phpspec run"
          }
       }
    )
}

stage("Tests [Acceptance]") {
    node {
       unstash "project_files"
       sh "bin/behat"
   }
}

stage("Deploying to UAT") {
    node {
        def gitCommit = gitCommit()
        ansiblePlaybook playbook: "ansible/deploy-uat.yml", inventory: "ansible/inventories/uat", extraVars: [release_version: "$gitCommit", secret_thing: [value: 'mySecretValue', hidden: true]]
    }
}

stage("Approval [UAT]") {
    // Make sure that you don't ask for input, or use a timeout within a node, it can tie up that node for the duration.
    timeout(time: 7, unit: 'DAYS') {
      input message: 'Does http://jenkins-workshop.uat look okay?'
    }
}

stage("Deploy to production") {
    timeout(time: 7, unit: 'DAYS') {
        input message: 'Go ahead with the deployment to production?'
    }

    node {
        def gitCommit = gitCommit()
        ansiblePlaybook playbook:"ansible/deploy-prod.yml", inventory: "ansible/inventories/prod", extraVars: [release_version: "$gitCommit"]
    }
}

/*
def to = emailextrecipients([
        [$class: 'CulpritsRecipientProvider'],
        [$class: 'DevelopersRecipientProvider'],
        [$class: 'RequesterRecipientProvider']
])
if(to != null && !to.isEmpty()) {
    mail to: to, subject: "Vagrant Test has finished with ${currentBuild.result}",
            body: "See ${env.BUILD_URL}"
}
*/

// Helper function to get the commit hash of the latest commit within git
def gitCommit() {
    sh(returnStdout: true, script: 'git rev-parse HEAD').trim()
}

def shortGitCommit() {
    gitCommit().take(6)
}
