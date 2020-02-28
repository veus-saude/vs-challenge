<template>
  <div>
    <div class="row mb-4">
      <section class="float-left col-md-12">
        <div class="row">
          <div class="col-md-3">
            <button class="btn btn-veus">Cadastrar Produto</button>
          </div>
        </div>
      </section>
    </div>

    <div class="row">
      <section class="col-md-12">
        <vue-good-table
          :columns="columns"
          :rows="rows"
        />
      </section>
    </div>

    <div class="row mt-5">
      <div class="col-md-12">
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">Próximo</a></li>
          </ul>
        </nav>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  name: 'Home',
  data() {
    return {
      columns: [
        {
          label: 'Name',
          field: 'name',
        },
        {
          label: 'Age',
          field: 'age',
          type: 'number',
        },
        {
          label: 'Created On',
          field: 'createdAt',
          type: 'date',
          dateInputFormat: 'yyyy-MM-dd',
          dateOutputFormat: 'MMM Do yy',
        },
        {
          label: 'Percent',
          field: 'score',
          type: 'percentage',
        },
      ],
      rows: [
        {
          id: 1, name: 'John', age: 20, createdAt: '', score: 0.03343,
        },
        {
          id: 1, name: 'Mary', age: 18, createdAt: '', score: 0.03343,
        },
        {
          id: 1, name: 'Styven', age: 20, createdAt: '', score: 0.03343,
        },
      ],
    };
  },
};
</script>
