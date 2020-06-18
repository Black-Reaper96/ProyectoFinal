#!/bin/bash
  echo ".-Deployment Process-."
   
  numProcess=`ps -ef | grep services-$1.jar | grep -v grep | wc -l`
 
  # solo ejecuta kill si el proceso esta arrancado
  if [ $numProcess -ne 0 ]; then
     echo "Stopping Beauty..."
     ps -ef | grep nombreApp-$1.jar | grep -v grep | awk '{print $2}' | xargs kill -9
  fi
 
  if [ $? == 0 ]; then
     echo "Beauty stopped."
     if [ -f services-$1.jar ]; then
        nohup java -jar services-$1.jar --spring.config.location=core/application.yml,service/application.yml > service.log &
        if [ $? == 0 ]; then
           echo "Installing jar..."
           sleep 45
           cat service.log
       	 echo "-------------------------------------------------------------------------------------------------------------"
           echo "DEPLOYMENT SUCCESS"
           echo "-------------------------------------------------------------------------------------------------------------"
           exit 0
 
        else
           echo "ERROR while trying to deploy service-$1.jar"
 
        fi
     else
       echo "services-$1.jar don't exist."
     fi
  else
    echo "ERROR while trying to stop the application."
  fi
  exit 1