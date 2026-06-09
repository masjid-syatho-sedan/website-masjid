pipeline {
    agent any

    // ─── Konfigurasi global deployment ───────────────────────────────────────
    environment {
        ZIP_NAME    = 'public_build.zip'
        REMOTE_HOST = '103.138.189.213'
        APP_PATH    = '/home/barizaloka/masjidsyathosedan.com/website-masjid'
        REMOTE_PATH = '/home/barizaloka/masjidsyathosedan.com/website-masjid/public/build'
        CRED_ID     = 'cpanel-ssh-barizaloka'
    }

    stages {

        // ─── 1. Install dependency PHP via Composer (dalam Docker) ────────────
        stage('Composer Install') {
            steps {
                sh '''
                    docker run --rm \
                        -v "$(pwd):/app" -w /app \
                        composer:latest \
                        composer install \
                            --no-interaction \
                            --prefer-dist \
                            --optimize-autoloader \
                            --ignore-platform-reqs
                '''
            }
        }

        // ─── 2. Install dependency Node & build asset frontend ────────────────
        stage('Node Build') {
            steps {
                sh '''
                    docker run --rm \
                        -v "$(pwd):/app" -w /app \
                        node:20-alpine \
                        sh -c "npm ci && npm run build"
                '''
            }
        }

        // ─── 3. Zip folder public/build hasil kompilasi asset ─────────────────
        stage('Zip Build') {
            steps {
                sh 'cd public/build && zip -r "$(pwd)/../../${ZIP_NAME}" .'
            }
        }

        // ─── 4. Upload zip ke server cPanel via SCP ───────────────────────────
        stage('Upload ke Server') {
            steps {
                withCredentials([usernamePassword(
                    credentialsId: "${CRED_ID}",
                    usernameVariable: 'SSH_USER',
                    passwordVariable: 'SSH_PASS'
                )]) {
                    sh '''
                        sshpass -p "$SSH_PASS" scp \
                            -o StrictHostKeyChecking=no \
                            ${ZIP_NAME} ${SSH_USER}@${REMOTE_HOST}:${APP_PATH}/${ZIP_NAME}
                    '''
                }
            }
        }

        // ─── 5. Ekstrak zip & bersihkan folder public/build di server ─────────
        stage('Ekstrak Build') {
            steps {
                withCredentials([usernamePassword(
                    credentialsId: "${CRED_ID}",
                    usernameVariable: 'SSH_USER',
                    passwordVariable: 'SSH_PASS'
                )]) {
                    sh '''
                        sshpass -p "$SSH_PASS" ssh \
                            -o StrictHostKeyChecking=no \
                            ${SSH_USER}@${REMOTE_HOST} "
                                rm -rf ${REMOTE_PATH}/* &&
                                unzip -o ${APP_PATH}/${ZIP_NAME} -d ${REMOTE_PATH} &&
                                rm -f ${APP_PATH}/${ZIP_NAME}
                            "
                    '''
                }
            }
        }

        // ─── 6. Pull kode terbaru dari branch master ──────────────────────────
        stage('Git Pull') {
            steps {
                withCredentials([usernamePassword(
                    credentialsId: "${CRED_ID}",
                    usernameVariable: 'SSH_USER',
                    passwordVariable: 'SSH_PASS'
                )]) {
                    sh '''
                        sshpass -p "$SSH_PASS" ssh \
                            -o StrictHostKeyChecking=no \
                            ${SSH_USER}@${REMOTE_HOST} \
                            "cd ${APP_PATH} && git pull origin master"
                    '''
                }
            }
        }

        // ─── 7. Jalankan migrasi database Laravel ─────────────────────────────
        stage('Migrate DB') {
            steps {
                withCredentials([usernamePassword(
                    credentialsId: "${CRED_ID}",
                    usernameVariable: 'SSH_USER',
                    passwordVariable: 'SSH_PASS'
                )]) {
                    sh '''
                        sshpass -p "$SSH_PASS" ssh \
                            -o StrictHostKeyChecking=no \
                            ${SSH_USER}@${REMOTE_HOST} \
                            "cd ${APP_PATH} && php artisan migrate --force"
                    '''
                }
            }
        }

        // ─── 8. Hapus zip sementara dari workspace Jenkins ────────────────────
        stage('Cleanup') {
            steps {
                sh 'rm -f ${ZIP_NAME}'
            }
        }
    }

    post {
        success { echo '✅ Deploy app.baricode.org berhasil!' }
        failure { echo '❌ Deploy gagal — cek log di atas.' }
    }
}
