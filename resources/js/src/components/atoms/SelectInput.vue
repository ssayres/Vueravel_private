<template>
    
<label for="inputCentroCusto">Centro de custo</label>
        <select
          class="form-select"
          >
          <option value="" selected>Escolha um item</option>
          <option value="Suzano">Suzano</option>
          <option value="Guarulhos">Guarulhos</option>
          <option value="Fontalis">Fontalis</option>
        </select>

</template>

<style lang="scss" scoped>
.select {
  outline: none;
  box-shadow: none !important;
}

.form-control:focus {
  border: 1px solid #e97b00;
  box-shadow: 0 0 4px #e97b00 !important;
}

.form-text {
  color: gray;
  font-size: 0.75rem;
}

.select {
    margin-top: 08px;
}
</style>