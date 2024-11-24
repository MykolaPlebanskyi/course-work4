pipeline {
    agent any
    stages {
        stage('Verify tooling') {
            steps {
                script {
                    sh '''
                    docker version
                    docker compose version
                    '''
                }
            }
        }
        stage('Clone repository') {
            steps {
                script {
                    if (!fileExists('.git')) {
                        echo "Cloning the repository..."
                        sh 'git clone https://github.com/MykolaPlebanskyi/course-work4.git .'
                    } else {
                        echo "Repository already cloned."
                    }
                }
            }
        }
        stage('Code analysis with sonarqube') {
          
          environment {
             scannerHome = tool 'sonarscanner'
          }

          steps {
            withSonarQubeEnv('sonarqube') {
               sh '''${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=vprofile \
                   -Dsonar.projectName=vprofile-repo \
                   -Dsonar.projectVersion=1.0 \
                   -Dsonar.sources=web/ \
                   -Dsonar.java.binaries=target/test-classes/com/visualpathit/account/controllerTest/ \
                   -Dsonar.junit.reportsPath=target/surefire-reports/ \
                   -Dsonar.jacoco.reportsPath=target/jacoco.exec \
                   -Dsonar.java.checkstyle.reportPaths=target/checkstyle-result.xml'''
            }
          }
        }
        stage('Prune Docker data') {
            steps {
                sh 'sudo docker system prune -a --volumes -f'
            }
        }
        stage('Start Docker Compose') {
            steps {
                sh 'sudo docker compose down --remove-orphans -v'
                sh 'sudo docker compose up -d'
                sh 'docker compose ps'
            }
        }
        stage('Copy and Import Database') {
            steps {
                script {
                    sh 'sleep 15'
                    sh 'sudo docker compose cp ./web/Database/ob_database.sql mariadb:/tmp/ob_database.sql'
                    sh '''
                    sudo docker compose exec mariadb bash -c "cat /tmp/ob_database.sql | mariadb -u occurence_user -pstrongpassword occurence_db"
                    '''
                    echo "All ready. You can follow the link http://localhost:8081 !"
                }
            }
        }
    }
    post {
        always {
            echo "Pipeline ended!"
        }
    }
}
