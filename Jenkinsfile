pipeline {
    agent any

    environment {
        DOCKERHUB_CREDENTIALS = 'dockerhub_credentials' // Your credential ID
        IMAGE_NAME = 'your-image-name' // Replace with your image name
        IMAGE_TAG = 'latest' // Replace with your desired tag
    }

    stages {
        stage('Checkout') {
            steps {
                // Checkout code from your repository
                git 'https://your-repo-url.git'
            }
        }
        stage('Build Docker Image') {
            steps {
                script {
                    // Login to Docker Hub
                    withCredentials([usernamePassword(credentialsId: DOCKERHUB_CREDENTIALS, usernameVariable: 'DOCKERHUB_USERNAME', passwordVariable: 'DOCKERHUB_PASSWORD')]) {
                        sh "docker login -u ${DOCKERHUB_USERNAME} -p ${DOCKERHUB_PASSWORD}"
                    }
                    // Build the Docker image
                    sh "docker build -t ${IMAGE_NAME}:${IMAGE_TAG} ."
                }
            }
        }
        stage('Run Docker Container') {
            steps {
                script {
                    // Run the Docker container
                    sh "docker run -d --name my_container ${IMAGE_NAME}:${IMAGE_TAG}"
                }
            }
        }
        stage('Push Docker Image') {
            steps {
                script {
                    // Push the image to Docker Hub
                    sh "docker push ${IMAGE_NAME}:${IMAGE_TAG}"
                }
            }
        }
    }

    post {
        always {
            echo 'Cleaning up...'
            sh "docker stop my_container || true"
            sh "docker rm my_container || true"
        }
    }
}
