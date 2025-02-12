@extends('layouts.sidebar')

@section('title', 'SISTEMA ADA')

@section('content')
<div id="index">
    <div class="row g-4 d-flex justify-content-center align-items-center">
        <!-- Coluna da imagem -->
        <div class="col-12 col-lg-6">
            <div class="col-lg-12 imgc text-center">
                <img class="index img-fluid" src="{{asset('img/figuras_cinza.png')}}" alt="Figuras">
            </div>
        </div>
        <!-- Coluna do texto -->
        <div class="col-12 col-lg-6">
            <div class="col-lg-12 text-container">
                <p class="index">
                    O ADA é um sistema web inovador, desenvolvido para oferecer uma visão abrangente e detalhada da infraestrutura e da capacidade operacional das unidades de atenção primária à saúde. Este sistema permite uma análise direcionada, integrando informações cruciais como a quantidade de laboratórios, policlínicas, Unidades Básicas de Saúde (UBS) e Unidades de Saúde da Família (USF), além de fornecer um georreferenciamento preciso dessas unidades.
                </p>
                <p class="index">
                    Com o ADA, gestores e profissionais de saúde podem visualizar cenários personalizados que refletem a realidade dos estabelecimentos de saúde, identificando pontos estratégicos de atenção e facilitando a tomada de decisões baseadas em dados. A interface intuitiva do sistema, que utiliza como base de dados o Cadastro Nacional de Estabelecimento de Saúde (CNES), permite um acompanhamento estratégico das equipes de atenção primária.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection