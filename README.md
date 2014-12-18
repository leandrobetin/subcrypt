subcrypt
========

Plugin jQuery/PHP para encriptação de dados de formulários HTML.

Esse plugin realiza a encriptação dos dados de um fomrulário html, antes de enviá-los via POST ao destino.<br />
Pode ser usado como 'alternativa' de segunrança em ambientes que não possuem conexão segura disponível (HTTPS).

overview:
-
Antes de realizar o <i>submit</i> do formulário, o plugin faz:
- Coleta os dados dos campos do formulário html.
- Cria um cookie no navegador com <i>tempo de vida<i> de 1 segundo, onde são armazenados os dados coletados.
- Faz a encriptação dos dados.
- Destrói o cookie criado anteriormente.
- Envia os dados criptografádos para o destino orignal do formulário.

como usar:
-
1 - Inclua o arquivo <b>subcrypt.js</b> ná página onde deseja utilizar:

<pre>&lt;script type="text/javascript" src="/subcrypt/subcrypt.js"&gt;&lt;/script&gt;</pre>

2 - Faça a chamada ao plugin associado ao formulário desejado:

<pre>
$('#my_button').click(function(){

  $('#my_form').subcrypt();

});
</pre>

3 - No arquivo PHP que receberá os dados do POST, inclua o arquivo <b>class_subcrypt.php</b> e utilize um objeto da classe <i>Subcrypt</i> para descriptografar os valores recebidos:

<pre>
  include_once 'class_subcrypt.php';
  
  $subcrypt = new Subcrypt(); //crie um nova instância de Subcrypt...
  
  $valor = $subcrypt->decode($_POST['valor']); //...utilize a instância(objeto) criado para descriptografar o valor.
</pre>

importante!
-
- No arquivo <b>class_subcrypt.php</b> deve-se definir sua <b>chave secreta</b> utilizada para criptografia/descriptografia dos dados:

<pre>
  private $secret_key = "my_secret_key"; //max 56 characteres
</pre>

- Por padrão o <b>path</b>(caminho padrão) da aplicação no plugin está definido como: <i>'/subcrypt/'</i>. Caso precise alterá-lo, passe o novo path como argumento na chamada do método:

<pre>
  $('#my_form').subcrypt({path: '/caminho/completo/para/o/diretorio/onde/esta/o/plugin/'});
  
  //ex: '/plugins/subcrypt/' ou 'http://www.seudominio.com.br/plugins/subcrypt/'
</pre>

- O plugin utiliza o caractere '/' como separador na hora de gravar os valores do formulário no cookie. Com isso, se algum dos campos do formulário tiverem esse caractere, o mesmo será substituído por um '_':

<pre>
  valor digitado no campo do formulário: meu/valor
  valor enviado/recebido no SUBMIT do formulário: meu_valor
  
  //Caso precise, pode-se mudar esse caractere passando o novo caractere como parâmetro:
  
  $('#my_form').subcrypt({ separator: '#' });
  
</pre>

dependências:
-

- jQuery. 
- PHP (com a extensão mcrypt ativa).
- Cookies ativos no navegador.

