<?php
//variaveis para calculo de CPF
$var_cpf_form = $_POST['cpf'];
$cpf = preg_replace( '/[^0-9]/is', '', $var_cpf_form );
$soma = 0;
$soma1 = 0;
$a = 11;

//variaveis para pesquisa de cpf em arquivo txt
$arquivo = file_get_contents("bancodedados.txt");
$cpf1 = strpos($arquivo, $_POST['cpf']);

//variaveis para armazenamento em arquivo txt
$login = $_POST['login'];
$senha = $_POST['senha'];
$email = $_POST['email'];

$f = fopen ("bancodedados.txt", "a+", 0);
$linha = "cadastro: " .$cpf. ", " .$login. ", " .$email. ", " .$senha. ";\n";


	for ($c = 0; $c < 10; $c++) 
		{
			//Calculo do 11 dígito
			$mult1 = $cpf[$c] * $a;
			$soma1 += $mult1;
			
			//Calculo do 10 dígito
			if ($a != 2)
			{
			$a1 = $a-1;
			$mult = $cpf[$c] * $a1;
			$soma += $mult;
			}
			$a-=1;
		}
				//Calculo do 10 dígito
				$resto = $soma % 11;
				$sub = 11 - $resto;
				
				//Calculo do 11 dígito
				$resto1 = $soma1 % 11;
				$sub1 = 11 - $resto1;


	//validacao de cpf já cadastrado
	if ($cpf1 == true){
	print "<script>alert('CPF já cadastrado!')</script>";
    }				
	
	//Validação do dígito e insercao no arquivo txt
	else if ($cpf[9] == $sub && $cpf[10] == $sub1){
	print "<script>alert('CPF cadastrado com sucesso!')</script>";
	fwrite ($f, $linha);
	fclose($f);
	}

	else
	print "<script>alert('CPF inválido!')</script>";

?> 