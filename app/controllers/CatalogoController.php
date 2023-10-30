<?php
class CatalogoController
{
    use ViewTrait;

    public function catalogo()
    {
        // Definir as marcas de televisores disponíveis
        $marcas = array("LG", "Samsung", "Sony", "Philips", "Panasonic");

        // Definir os tamanhos de televisores disponíveis
        $tamanhos = array("32 polegadas", "40 polegadas", "50 polegadas", "55 polegadas", "65 polegadas");

        // Criar o array de televisores
        $televisores = array();

        // Loop para criar 25 televisores
        for ($i = 1; $i <= 25; $i++) {
            // Gerar nome aleatório do televisor com marca e tamanho
            $marca_aleatoria = $marcas[array_rand($marcas)];
            $tamanho_aleatorio = $tamanhos[array_rand($tamanhos)];
            $nome_aleatorio = $marca_aleatoria . " " . $tamanho_aleatorio;


            // Gerar código aleatório de 6 dígitos
            $codigo_aleatorio = sprintf("%06d", rand(1, 999999));

            // Gerar preço aleatório em R$
            $preco_aleatorio = rand(1000, 5000);

            // Adicionar o televisor ao array
            $televisores[] = array(
                "Código" => $codigo_aleatorio,
                "Nome" => $nome_aleatorio,
                "Valor" => "R$ " . number_format($preco_aleatorio, 2, ',', '.')
            );
        }
        $this->view('catalogo', ['televisores' => $televisores]);
    }
}
