<h1 align="center">OrangeCode - Helpers</h1>

<p>🚀 Conjunto de funções utilizadas para manipulação de dados em projetos PHP.</p>

<img src="https://img.shields.io/static/v1?label=License&message=MIT&color=success"/>
<img src="https://img.shields.io/static/v1?label=CORE&message=PHP&color=blue&logo=php"/>
<img src="https://img.shields.io/static/v1?label=Framework&message=Lavarel&color=blue&logo=laravel"/>
<img src="https://scrutinizer-ci.com/g/Nandovga/orangecode-helpers/badges/build.png?b=master"/>
<img src="https://scrutinizer-ci.com/g/Nandovga/orangecode-helpers/badges/quality-score.png?b=master"/>


### ✨ Instalação

A instalação do pacote é bem simples, basta executar essa linha de comando no terminal de sua aplicação.

```bash
composer require orangecode/helpers
```

### ⚙️ Funções disponíveis

- Especificas para o Laravel:
    - [x] <b style='color: #FA377B'>isActiveRoute</b> Verifica se o <span style='color: #E583A5FF'>route('example')</span>
      parametrizada está sendo acessada, e retorna uma classe CSS para manipulação das <span style='color: #E583A5FF'>
      view('blade')</span> blade

- Manipulação de chaves:
    - [x] <b style='color: #3CA3E8'>genereteKey</b> Gera senhas de forma randomica
- Manipulação de data e horas:
    - [x] <b style='color: #3CA3E8'>decimalToHours</b> Converte as horas de string para decimal
    - [x] <b style='color: #3CA3E8'>hoursToDecimal</b> Converte um número do tipo float para string
    - [x] <b style='color: #3CA3E8'>hoursToMinute</b> Converte as horas em minutos
    - [x] <b style='color: #3CA3E8'>minuteToHours</b> Converte os minutos para horas
    - [x] <b style='color: #3CA3E8'>secondsToHours</b> Converte os segundos para horas
    - [x] <b style='color: #3CA3E8'>sumHours</b> Retorna a soma das horas por periodo
    - [x] <b style='color: #3CA3E8'>isDateInRange</b> Verifica se a data está entre as datas parametrizadas
- Conversão de dados:
    - [x] <b style='color: #3CA3E8'>EnumArray</b> Converte um enumerado para array

##### ⚒️ Motivação

O objetivo deste pacote é disponibilizar funções que agilizem a manipulação de dados em
projetos <a href='https://www.php.net/'>PHP</a>. Ele também pode ser utilizado em frameworks populares, como
o <a href='https://laravel.com/'>Laravel</a>, por exemplo.

#### 👨‍💻 Desenvolvedor

<img style="border-radius: 50%;" src="https://avatars.githubusercontent.com/u/35897906?s=400&u=a25ace405c6c9412844ba7b6a6b3a0b68c6f8296&v=4" width="80px;" alt="Avatar"/>
<br />
<sub><b>Luiz Fernando Bernardes de Paula</b>🚀</sub>

Feito com ❤️ por Luiz Fernando 👋🏽 Entre em contato!

[![Linkedin Badge](https://img.shields.io/static/v1?label=&message=LinkedIn&color=blue&style=flat-square&logo=LinkedIn)](https://www.linkedin.com/in/luiz-fernando-bernardes-de-paula-605497a4/)
