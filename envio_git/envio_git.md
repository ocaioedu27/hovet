#enviando arquivos para o git

git init

git add .

git status

git commit -m "projeto hovet"

git config --global user.email "mail@gmail.com"
git config --global user.user "username"

git commit -m "projeto hovet"

git branch -M main

git remote add origin git@github.com:projhovet/projeto_hovet.git

git push -u origin main


#### Envio de arquivos para o repositório já existente
  
git add .
git status
git commit -m "edicao de arquivos do deposito"
git push origin main
