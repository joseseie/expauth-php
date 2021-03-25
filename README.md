
# Sobre este pacote

Pacote de integração de autenticação no projecto Laravel a partir da versão 7.

Este pacote vai disponibilizar uma dialog que poderá ser montada em qualquer parte do website com as principais opções de autenticação: Google, Facebook, LinkedIn, Github e Explicador.

Se deseja implementar todas ou qualquer uma das opções mencionadas acima, este é o pacote certo para si. 

Este pacote utiliza um outro pacote socialite ([Oficial de Laravel](https://laravel.com/docs/7.x/socialite)) para essa integração, depois precisará de fazer pequenas configurações de apenas 2 minutos. 😍 

### Requisitos para correr o projecto

1. Laravel v7
2. Bootstrap 4 (CSS e JS)
3. Jquery 3.0

## Passos para instalação

### 1. Instalar o pacote
```
composer require explicador/expauth-php
```

### 2. Configurações

Inserir essa linha em `config/app.php` no array dos `aliases`: 

```
 'Socialite' => Laravel\Socialite\Facades\Socialite::class,
```

Inserir essa linha em `config/app.php` no array dos `providers:` 

```
 Laravel\Socialite\SocialiteServiceProvider::class,
```

### 3. Criação de migrations

```
 $ php artisan migrate
```

### 4. Publique o pacote

```
 $  php artisan vendor:publish e escolher a Opção Explicador\Authentication\ExpAuth
```

### 5. Configuração  do `.env`

Chaves da provedora de autenticação.

Insira apenas as chaves das provedoras que deseja utilizar, copie as chaves e cole no seu ficheiro .env

```
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_CLIENT_REDIRECT=

FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
FACEBOOK_CLIENT_REDIRECT=

LINKEDIN_CLIENT_ID=
LINKEDIN_CLIENT_SECRET=
LINKEDIN_CLIENT_REDIRECT=

GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_CLIENT_REDIRECT=

EXPLICADOR_CLIENT_ID=
EXPLICADOR_CLIENT_SECRET=
EXPLICADOR_CLIENT_REDIRECT=
```

## Outras configurações

Todas elas disponibilizam chaves a serem incluídas no ficheiro `.env`

### 1. Rota para o redirecionamento

Após a autenticação feita pela provedora, é necessário indicar uma rota para onde redirecionar o user no projecto local. Para isso no ficheiro `.env`

```
DEFAULT_REDIRECT_OAUTH=/dashboard
```

### 2. Logo a ser apresentado na autenticação com o provider `Explicador` (opcional)

O logo é importante para que os seus usuários possam ter uma tela familiar no processo de autenticação com a conta da Explicador Inc, LDA. Esse logo, será apresentado quando o utilizador for redirecionado para a tela de consentimento.

Coloque o link da imagem que deseja que seja apresentado. A imagem deve ser PNG com 300x300px.

```
LOGO_PATH=
```

### 3. Configuração dos callbacks

Os redirects são configurados nas consolas de desenvolvedores das provedoras. 

- Consola da Google: [https://developers.google.com/identity/sign-in/web/sign-in](https://developers.google.com/identity/sign-in/web/sign-in)
- [Consola do Facebook ](https://developers.facebook.com/apps/)
- [Consola do Linkedin](https://www.linkedin.com/developers/apps)
- [ Consola do Github ](https://github.com/settings/developers)


Defina os redirects no seguinte formato:

#### Exemplos:

https://meusite.com/auth/google/callback
http://localhost:8000/auth/linkedin/callback
https://meuproduto.com/auth/{provedora}/callback
http://localhost:9000/auth/{provedora}/callback

> Note que se o seu site estiver em produção, é importante que tenha certificado de segurança, ou seja, o site deve correr no protocolo **https** exemplo: https://explicador.co.mz


## Integrando a dialog na página
 
### 1.  Dependências necessárias:

As dependências (Bootsrap 4 CSS +JS, Jquery 3 e Fontawesome 4.7) necessárias serão incluídas pelo único include de assets abaixo. Note que você pode remover, alterar ou adicionar referencias a outros ficheiros de layout neste include.

Coloque este código no header do layout da página onde deseja visualizar a dialog.

```
@include('expauth::include-assets')
```

### 2. View da dialog

Para incluir a view da dialog, insira esse include na página da página onde deseja que a mesma apareça.

```
@include('expauth::dialogs.login-dialog')
```
### 3. Invoque a dialog

Basta apenas colar e personalizar o código abaixo na parte do html onde deseja montar a dialog.

```
<a href="#"  data-toggle="modal" data-target=".exp-auth-dialog">
     <i class="fas fa-info-circle"></i>&nbsp; Meu Login
</a>
```


Autores
-------

* [Arnaldo Manuel] @arnaldomanuel 
* [José Seie] @joseseie
* [The Community Contributors]

Contribuições
----------

Contribuições para esse pacote são bem vindas!

* Pode reportar qualquer bug ou issue.
* Pode clonar este repositório implementar melhorias e submeter pull request;
* Pode editar README.

License
-------

All contents of this package are licensed under the [MIT license].

