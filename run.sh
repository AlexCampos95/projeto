#!/bin/bash

makemigrations(){
    sleep 5
    {    
        opcaoMigrations='n'        
        docker exec -it pp-users-phpfpm php artisan migrate
        docker exec -it pp-transactions-phpfpm php artisan migrate
        docker exec -it pp-balance-phpfpm php artisan migrate
    } || { 
        opcaoMigrations='s'
    }
    
}

makeseeds(){
    sleep 5
    {    
        opcaoSeeds='n'        
        docker exec -it pp-users-phpfpm php artisan db:seed
        docker exec -it pp-balance-phpfpm php artisan db:seed
    } || { 
        opcaoSeeds='s'
    }
    
}

opcaoMigrations='s'
opcaoSeeds='s'

errUp='6'
errCp='6'
errMig='6'
errDependencias='6'
errSeeds='6'

echo '\033[40;1;36m........|¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨|....‡       '
echo '........| Iniciando Processo |||¨|¨¨\__   ' 
echo '........|____________________|||_|____|)< '
echo '........!(@)¨(@)¨¨¨¨**!(@)(@)****!(@)     \033[0m'

cd ./docker/ 
echo '\033[40;1;34m------------------------------------------------\033[0m'

{
    errUp='0'    
    echo Uploading Application container 
    docker-compose up -d
} ||{
    errUp='1'
    errDep='1'
    errCp='1'
    errMig='1'
    errSeeds='1'
}    
echo ------------------------------------------------
if [ $errUp = '0' ] 
then
{
    errDependencias='0'
    echo Instalndo dependências
    docker exec -it pp-users-phpfpm composer install
    docker exec -it pp-transactions-phpfpm composer install
    docker exec -it pp-balance-phpfpm composer install
    docker exec -it pp-notifications-phpfpm composer install
} || {
    errDependencias='1'
    errCp='1'
    errMig='1'
    errSeeds='1'
}
fi
echo ------------------------------------------------    
if [ $errDependencias = '0' ] 
then
{
    errCp='0'
    echo Copying the configuration example file
    cp ./dev-env/.env.users ./pp-users/.env
    cp ./dev-env/.env.transactions ./pp-transactions/.env     
    cp ./dev-env/.env.balance ./pp-balance/.env
    cp ./dev-env/.env.notifications ./pp-notifications/.env
} || {
    errCp='1'
    errMig='1'
    errSeeds='1'
} 
fi
echo ------------------------------------------------       
if [ $errCp = '0' ] 
then
{   
    errMig='0'
    echo Executando migrations
    makemigrations
} || {
                
    while [ $opcaoMigrations != 'n' ]
    do
        echo '\033[1;33mHouve algum problema com as migrations...' 
        echo 'Caso o container do BD tenha subido recentemente' 
        echo 'pode haver problemas de conexão.' 
        echo 'Se for esse o caso, aguarde 10 segundos e tente outra vez.'
        echo -n "\n Deseja tentar novamente?[S/N]: \033[0m"
        read opcao
        case $opcaoMigrations in
            S|s) makemigrations ;;
            n|N) opcao='n'; errMig='1' ;;              
              *) echo "Opção desconhecida."  ;;
        esac	
                    
    done
} 
fi   

echo ------------------------------------------------       
if [ $errMig = '0' ] 
then
{   
    errSeeds='0'
    echo Executando Seeders
    makeseeds
} || {
                
    while [ $opcaoSeeds != 'n' ]
    do
        echo '\033[1;33mHouve algum problema com a execução dos Seeders...' 
        echo 'Caso o container do BD tenha subido recentemente' 
        echo 'pode haver problemas de conexão.' 
        echo 'Se for esse o caso, aguarde 10 segundos e tente outra vez.'
        echo -n "\n Deseja tentar novamente?[S/N]: \033[0m"
        read opcao
        case $opcaoSeeds in
            S|s) makeseeds ;;
            n|N) opcao='n'; errSeed='1' ;;              
              *) echo "Opção desconhecida."  ;;
        esac	
                    
    done
} 
fi            

echo ------------------------------------------------

echo Informações sobre os Containers
docker ps -a 
echo ------------------------------------------------
cd ..
erro=$errMig$errCp$errUp$errDependencias$errSeeds
#echo $erro
if [ $erro != '00000' ]
then
    
    echo '\033[1;33m  ╭━━━━╮  '
    echo '  ┃ + +┃  '
    echo ' ┗┫┏━━┓┣┛ '
    echo '  ┃    ┃  Script concluído! '
    echo '  ╰┳━━┳╯  ...MAS ... \033[0m'
    

    if [ $errMig = '1' ]
    then
        echo "\033[43;1;37mverifique os problemas de BD (migrations) :( \033[0m"
    fi

    if [ $errCp = '1' ]
    then
        echo "\033[43;1;37mverifique a configuraçã do .env :( \033[0m"
    fi

    if [ $errUp = '1' ]
    then
        echo "\033[41;1;37mverifique os containers! :( \033[0m"
    fi

    if [ $errDependencias = '1' ]
    then
        echo "\033[41;1;37mTavlez necessidade de Rodar o composer install manualmente no projeto! :( \033[0m"
    fi

    if [ $errSeeds = '1' ]
    then
        echo "\033[41;1;37m Houve algum problema ao rodas as seeds \033[0m"
    fi

else    

    echo '            \033[1;32m\033[0m             ╰╮╰ ╰ ╰╮                   '
    echo '.........\033[1;32m\033[0m....................╭╯╭╯╰╮╰╮               '
    echo '..........\033[1;32m\033[0m...................╰╮╰╮ ╭ .╭ ╯╭╯╭╯        '
    echo '.·.\033[1;32m╭━━━━╮\033[0m·. ·. ·.·. ·.·. ·. ▓█████████████████▓     '
    echo '.·.\033[1;32m┃╭╮╭╮┃\033[0m·. ·. ·.·. ·.·. ·. █   Servers Up!   █     '
    echo '.·\033[1;32m┗┫┏━━┓┣┛\033[0m·. ·. ·.·. ·.·. · █▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓█████ '
    echo '.·.\033[1;32m┃╰━━╯┃\033[0m. ·. ·. ·.·. ·.··. █▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓█..██ ' 
    echo '. ·\033[1;32m╰┳━━┳╯\033[0m. ·. ·.·. ·.·. . ·.█▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓█████  '
    echo '.\033[1;32m Pode usar o sistema! \033[0m ·.·. █▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓█      '
    echo '.\033[1;32m\033[0m  ·. ·. ·.·. ·.·. ·.·.·.·. . █▓▓▓▓▓▓▓▓▓▓▓▓▓█       '
    echo '. ·. ·.\033[1;32m\033[0m ·.·. ·.·. ·.·. ·..··. ·█▓▓▓▓▓▓▓▓▓▓▓█        '
    echo '. ·. ·.\033[1;32m\033[0m .·. ·.·. ·.·. ·.·. ▓███████████████████▓    '
    echo '. ·. ·.\033[1;32m\033[0m .·.·. ·.·. ·.·. ·.. · ▓██████████████       '

fi







