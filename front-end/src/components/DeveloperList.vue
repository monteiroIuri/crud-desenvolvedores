<template>
  <div>
    <b-container fluid class="mt-4">
      <b-row no-gutters>
        <b-col cols="1"></b-col>
        <b-col cols="10">
          <b-card title="Card Title" no-body>
            <b-card-header header-tag="nav">
              <b-row no-gutters>
                <b-col>
                  <b-nav-form>
                    <b-form-input
                      id="filter-input"
                      v-model="filter"
                      type="search"
                      placeholder="Filtro"
                    ></b-form-input>
                  </b-nav-form>
                </b-col>
                <b-col>
                  <b-nav card-header pills align="right">
                    <b-button v-b-modal.modal-prevent-closing variant="success"
                      >Cadastrar</b-button
                    >
                  </b-nav>
                </b-col>
              </b-row>
            </b-card-header>
            <b-alert
              class="m-2"
              :show="showAlert"
              v-model="showAlert"
              :variant="typeVariantAlert"
              align="center"
              dismissible
            >
              {{ message }}
            </b-alert>
            <b-card-body>
              <b-card-text>
                <b-table
                  responsive="sm"
                  striped
                  bordered
                  borderless
                  outlined
                  primary-key="id"
                  :filter="filter"
                  :items="items"
                  :fields="fields"
                >
                  <template #cell(acoes)="row">
                    <b-button-group size="sm">
                      <b-button
                        variant="success mx-2"
                        @click="editDeveloper(row.item.id)"
                        >Editar
                      </b-button>
                      <b-button
                        variant="danger"
                        @click="deleteDeveloper(row.item.id, row.index)"
                      >
                        Excluir
                      </b-button>
                    </b-button-group>
                  </template>
                </b-table>
              </b-card-text>
            </b-card-body>
          </b-card>
        </b-col>
      </b-row>
    </b-container>

    <!-- area do modal -->
    <b-modal
      id="modal-prevent-closing"
      ref="modal"
      title="Cadastrar Desenvolvedor"
      @show="resetModal"
      @hidden="resetModal"
      @ok="handleOk"
    >
      <template>
        <form ref="form" @submit.stop.prevent="handleSubmit">
          <b-form-group label="Nome" label-for="nome">
            <b-form-input
              id="nome"
              v-model="nome"
              :state="validateName"
              required
              placeholder="Digite seu nome"
              type="text"
              autocomplete="false"
            ></b-form-input>
            <b-form-invalid-feedback :state="validateName">
              O nome deve ter mo minimo 3 e no máximo 220 caracteres.
            </b-form-invalid-feedback>
            <b-form-valid-feedback :state="validateName">
              Tudo certo!
            </b-form-valid-feedback>
          </b-form-group>

          <b-form-group label="Sexo" label-for="sexo">
            <b-form-select
              id="sexo"
              required
              :options="sexoOptions"
              v-model="sexo"
              :state="validateSex"
            ></b-form-select>
            <b-form-invalid-feedback :state="validateSex">
              Selecione o sexo
            </b-form-invalid-feedback>
            <b-form-valid-feedback :state="validateSex">
              Tudo certo!
            </b-form-valid-feedback>
          </b-form-group>

          <b-form-group label="Idade" label-for="idade">
            <b-form-input
              id="idade"
              v-model="idade"
              :state="validateAge"
              required
              placeholder="Qual a sua idade?"
              type="number"
              autocomplete="off"
              @keypress="verifyAge"
            ></b-form-input>
            <b-form-invalid-feedback :state="validateAge">
              Idade deve possuir ao menos um valor, no máximo 3 e ser menor que
              150.
            </b-form-invalid-feedback>
            <b-form-valid-feedback :state="validateAge">
              Tudo certo!
            </b-form-valid-feedback>
          </b-form-group>

          <b-form-group label="Hobby" label-for="hobby">
            <b-form-input
              id="hobby"
              v-model="hobby"
              required
              placeholder="Nos diga o hobby que você mais gosta..."
              type="text"
              :state="validateHobby"
              autocomplete="false"
            ></b-form-input>
          </b-form-group>

          <b-form-group label="Data de Nascimento" label-for="dataNascimento">
            <b-form-datepicker
              id="dataNascimento"
              v-model="dataNascimento"
              selected-variant="success"
              today-variant="info"
              nav-button-variant="primary"
              type="text"
              class="mb-2"
              :date-format-options="{
                day: 'numeric',
                month: 'numeric',
                year: 'numeric',
              }"
              :state="validateBirthDate"
              placeholder="DD/MM/YYYY"
            >
            </b-form-datepicker>
          </b-form-group>
          <b-alert
            class="m-2"
            :show="showMessageRequiredFields"
            v-model="showMessageRequiredFields"
            variant="info"
            align="center"
            dismissible
            fade
          >
            Verifique os campos obrigatórios!
          </b-alert>
        </form>
      </template>

      <template #modal-footer="{ ok, cancel }">
        <b-button size="sm" variant="success" @click="ok()">Salvar</b-button>
        <b-button size="sm" variant="danger" @click="cancel()"
          >Cancelar</b-button
        >
      </template>
    </b-modal>

    <!-- fim modal -->
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";

export default {
  name: "developers",
  data() {
    return {
      fields: [
        { key: "nome", label: "Nome", sortable: true },
        { key: "sexo", label: "Sexo" },
        { key: "idade", label: "Idade" },
        { key: "datanascimento", label: "Data de Nascimento" },
        { key: "hobby", label: "Hobby" },
        { key: "acoes", label: "Ações" },
      ],
      items: [],
      filter: "",
      message: "",
      showAlert: false,
      typeVariantAlert: "",
      id: "",
      nome: "",
      sexo: "",
      idade: "",
      hobby: "",
      dataNascimento: "",
      sexoOptions: [
        { value: "M", text: "Masculino" },
        { value: "F", text: "Feminino" },
      ],
      showMessageRequiredFields: false,
    };
  },
  methods: {
    formatDate(date) {
      return moment(String(date)).format("DD/MM/YYYY");
    },
    verifyItems(objeto) {
      let data = objeto;

      for (var i = 0; i < data.length; i++) {
        data[i].sexo =
          data[i].sexo.toUpperCase() == "M" ? "Masculino" : "Feminino";
        data[i].datanascimento = this.formatDate(data[i].datanascimento);
      }

      return data;
    },
    showMessageRequisition(typeAlert = "success", showAlert, messageAlert) {
      this.typeVariantAlert = typeAlert;
      this.showAlert = showAlert;
      this.message = messageAlert;
    },
    getDevelopers() {
      axios
        .get("/developers")
        .then((response) => {
          if (response.data.status == 200 && response.data.data.length) {
            this.items = this.verifyItems(response.data.data);
            return;
          }

          this.showMessageRequisition(
            "info",
            5,
            "Nenhum desenvolvedor encontrado!"
          );
        })
        .catch((e) => console.log(e));
    },
    deleteDeveloper(id, index) {
      axios
        .delete("/developers/" + id)
        .then((response) => {
          if (response.status == 204) {
            this.items.splice(index, 1);
            this.showMessageRequisition(
              "success",
              5,
              "Desenvolvedor excluido com sucesso!"
            );
          }
        })
        .catch((e) => {
          if (e.response.data && e.response.status == 404) {
            this.showMessageRequisition("danger", 5, e.response.data.message);
            return;
          }

          this.showMessageRequisition(
            "danger",
            5,
            "An unexpected error occurred!"
          );
          console.log(e);
        });
    },
    createDeveloper(data) {
      let developer = {};
      developer = data;

      axios
        .post("/developers/store", developer, {
          headers: {
            "Content-Type": "application/json",
            "Access-Control-Allow-Origin": "*",
          },
        })
        .then((response) => {
          if (response.status == 201) {
            this.showMessageRequisition(
              "success",
              5,
              "Desenvolvedor cadastrado com sucesso!"
            );
            this.getDevelopers();
            return;
          }

          this.showMessageRequisition("danger", 5, response.data.data.message);
        })
        .catch((e) => console.log(e));
    },
    editDeveloper(id) {
      axios
        .get("/developers/" + id)
        .then((response) => {
          let data = {};
          data = response.data.data[0];
          this.$refs["modal"].show();
          this.id = data.id;
          this.nome = data.nome;
          this.sexo = data.sexo;
          this.idade = data.idade;
          this.hobby = data.hobby;
          this.dataNascimento = data.datanascimento;
        })
        .catch((e) => console.log(e));
    },
    updateDeveloper(data) {
      let developer = {};
      developer = data;
      axios
        .put("/developers/" + developer.id, developer, {
          headers: {
            "Content-Type": "application/json",
          },
        })
        .then((response) => {
          if (response.status == 200) {
            this.showMessageRequisition(
              "success",
              5,
              "Desenvolvedor editado com sucesso!"
            );
            this.getDevelopers();
            return;
          }

          this.showMessageRequisition("danger", 5, response.data.data.message);
        });
    },
    resetModal() {
      this.id = "";
      this.nome = "";
      this.sexo = "";
      this.idade = "";
      this.hobby = "";
      this.dataNascimento = "";
      this.showMessageRequiredFields = false;
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      // Trigger submit handler
      if (
        this.nome.length < 3 ||
        this.sexo.length <= 0 ||
        this.hobby.length <= 0 ||
        this.idade <= 0
      ) {
        this.showMessageRequiredFields = 5;
        return;
      }

      let data = {
        id: this.id,
        nome: this.nome,
        sexo: this.sexo,
        idade: this.idade,
        hobby: this.hobby,
        datanascimento: this.dataNascimento,
      };

      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-closing");
      });

      if (this.id) {
        this.updateDeveloper(data);
        return;
      }

      this.createDeveloper(data);
    },
    verifyAge() {
      this.idade = String(this.idade).replace(/[0-9]{3}/, "");
    },
  },
  mounted() {
    this.getDevelopers();
  },
  computed: {
    rows() {
     return this.items.length;
    },
    validateName() {
      if (this.nome.length < 3) {
        return false;
      }

      return true;
    },
    validateSex() {
      if (this.sexo.length <= 0) {
        return false;
      }

      return true;
    },
    validateAge() {
      if (this.idade.length <= 0 || this.idade.length > 3 || this.idade > 150) {
        return false;
      }

      return true;
    },
    validateHobby() {
      if (this.hobby.length <= 0) {
        return false;
      }

      return true;
    },
    validateBirthDate() {
      if (this.dataNascimento.length <= 0) {
        return false;
      }

      return true;
    },
  },
};
</script>

<style scoped>
</style>
