pipeline {
    agent any
    stages {
        stage('Verify tooling') {
            steps {
                script {
                    sh '''
                    docker info
                    docker version
                    docker compose version
                    '''
                }
            }
        }
        stage('Prune DOcker data') {
            steps {
                sh 'sudo docker sysyem prune -a --volumes -f'
            }
        }
        stage('Start Docker Compose') {
            steps {
                sh 'sudo docker compose up -d --no-color --wait'
                sh 'docker compose ps'
            }
        }
        stage('Run tests'){
            steps{
                sh 'curl http://localhost:8081 | jq'
            }
        }
    }
    post {
        always {
            sh 'sleep 30'
            sh 'sudo docker compose down --remove-orphans -v'
            sh 'sudo docker compose ps'
            echo "Pipeline завершено!"
        }
    }
}

