@extends('layouts.sidebar')

@section('content')
        <div class="container mt-5">
            <h1>Editar Portaria</h1>

            <form action="{{ route('portarias.update', $portaria->INE) }}" method="POST" id="editForm">
                @csrf
                @method('PUT')

                <!-- Caixa de pesquisa para a Equipe (INE / EQUIPE) -->
                <div class="mb-3">
                    <label for="ineSearch" class="form-label">Pesquise ou Selecione a Equipe</label>
                    <input type="text" class="form-control" id="ineSearch" placeholder="Pesquise por uma equipe">
                </div>

                <!-- INE da Portaria -->
                <div class="mb-3">
                    <label for="inePortaria" class="form-label">INE da Portaria</label>
                    <select class="form-control" id="inePortaria" name="inePortaria">
                        @foreach($inePortarias as $ine)
                            <option value="{{ $ine }}" {{ $portaria->INE == $ine ? 'selected' : '' }}>
                                {{ $ine }}
                            </option>
                        @endforeach
                    </select>
                </div>


                                <!-- Equipe -->
                <div class="mb-3">
                    <label for="INE" class="form-label">Equipe</label>
                    <select class="form-control" id="INE" name="INE" required>
                        @foreach($equipes as $equi_ine => $equi_nome)
                            <option value="{{ $equi_ine }}" {{ $portaria->INE == $equi_ine ? 'selected' : '' }}>
                                {{ $equi_nome }}
                            </option>
                        @endforeach
                    </select>
                </div>




                <!-- Caixa de texto para o nome da Portaria -->
                <div class="mb-3">
                    <label for="PRT_MS" class="form-label">Portaria</label>
                    <input 
                        type="text" 
                        class="form-control editable" 
                        id="PRT_MS" 
                        name="PRT_MS"
                        value="{{ old('PRT_MS', $portaria->PRT_MS ?? '') }}{{ $portaria->PRT_MS ? ' - ' . $portaria->equi_nome : '' }}" 
                        required>
                </div>

                <!-- Caixa de texto para o Tipo de Portaria -->
                <div class="mb-3">
                    <label for="TIPO" class="form-label">Tipologia da Equipe</label>
                    <input type="text" class="form-control editable" id="TIPO" name="TIPO" 
                        value="{{ old('TIPO', $portaria->TIPO) }}" required>
                </div>

                <!-- Status da Portaria -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status da Portaria</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="1" selected>Homologada</option>
                        <option value="0">Não Homologada / Desemologada</option>
                    </select>
                </div>


                <!-- Botões -->
                <button type="submit" class="btn btn-primary">Alterar</button>
                <a href="{{ route('portarias.index') }}" class="btn btn-secondary">Voltar</a>
            </form>
        </div>

        <!-- Script para desativar campos -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const statusField = document.getElementById('status');
                const editableFields = document.querySelectorAll('.editable');

                function toggleFields() {
                    const status = statusField.value;
                    const isDisabled = status === '0'; // "Não Homologada / Desemologada"

                    editableFields.forEach(field => {
                        field.disabled = isDisabled;
                    });
                }

                // Verifica o status inicial
                toggleFields();

                // Atualiza os campos ao alterar o status
                statusField.addEventListener('change', toggleFields);

                // Função de filtro para a caixa de seleção
                const ineSearch = document.getElementById('ineSearch');
                const ineSelect = document.getElementById('ine');
                ineSearch.addEventListener('input', function () {
                    const searchValue = ineSearch.value.toLowerCase();
                    const options = ineSelect.options;
                    
                    for (let i = 0; i < options.length; i++) {
                        const optionText = options[i].text.toLowerCase();
                        options[i].style.display = optionText.includes(searchValue) ? '' : 'none';
                    }
                });

                // Verificar se o status enviado está correto antes do envio do formulário
                document.getElementById("editForm").addEventListener("submit", function(event) {
                    const status = document.getElementById("status").value;
                    console.log("Status enviado:", status); // Verificar no console se o valor está correto
                });
            });
        </script>
    </body>
    </html>
@endsection