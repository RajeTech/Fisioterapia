        <div class="row">
          <div class="col-4">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome" value="{{$dadosModal['nome']}}" maxlength="200">
          </div>
          <div class="col-2">
            <label>Sexo</label>
            <select class="form-control" name="sexo">
              <option value="">Selecione...</option>
              <option {{$dadosModal['sexo']=='Masculino'?'selected':'' }}>Masculino</option>
              <option {{$dadosModal['sexo']=='Feminino'?'selected':'' }}>Feminino</option>
            </select>
          </div>
          <div class="col-2">
            <label>CPF</label>
            <input type="text" class="form-control" name="CPF" value="{{$dadosModal['CPF']}}"  maxlength="20">
          </div>
          <div class="col-2">
            <label>RG</label>
            <input type="text" class="form-control" name="RG" value="{{$dadosModal['RG']}}"  maxlength="20">
          </div>

          <div class="col-2">
            <label>CNS</label>
            <input type="text" class="form-control" name="CNS" value="{{$dadosModal['CNS']}}"  maxlength="50">
          </div>

          <div class="col-3">
            <label>Telefone</label>
            <input type="text" class="form-control" name="telefone" value="{{$dadosModal['telefone']}}"  maxlength="20">
          </div>

          <div class="col-3">
            <label>Data de Nascimento</label>
            <input type="date" class="form-control" name="DTnascimento" value="{{$dadosModal['DTnascimento']}}" >
          </div>
          <div class="col-12">
            <hr>
          </div>
          <div class="col-4">
            <label>Endereço</label>
            <input type="text" class="form-control" name="ruaEndereco" maxlength="500" value="{{$dadosModal['ruaEndereco']}}" >
          </div>

          <div class="col-4">
            <label>Bairro</label>
            <input type="text" class="form-control" name="bairroEndereco" maxlength="500" value="{{$dadosModal['bairroEndereco']}}" >
          </div>

          <div class="col-1">
            <label>Numero</label>
            <input type="text" class="form-control" name="numeroEndereco" maxlength="10" value="{{$dadosModal['numeroEndereco']}}" >
          </div>

          <div class="col-3">
            <label>Cidade e Estado</label>
            <input type="text" class="form-control" name="cidadeEndereco" maxlength="500" value="{{$dadosModal['cidadeEndereco']}}" >
          </div>
          <div class="col-2">
            <label>Sessões</label>
            <input type="number" class="form-control" name="sessoes" value="{{$dadosModal['sessoes']}}"  maxlength="50">
          </div>

          <div class="col-4">
            <label>Acompanhante</label>
            <input type="text" class="form-control" name="acompanhante" value="{{$dadosModal['acompanhante']}}"  maxlength="50">
          </div>
          <div class="col-12">
            <hr>
          </div>

        </div>
