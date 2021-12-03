<template>
  <div>
    <div class="row">
      <div class="col-sm-5 col-md-8 content-primary">
        <h5 style="margin-top: 30px">Statistics for {{ id }}</h5>
        <div class="content">
          <div class="row align-items-center">
            <div class="form-group col-md-3">
              <select id="inputState" class="form-control">
                <option selected>22/11/2021</option>
                <option>21/11/2021</option>
                <option>20/11/2021</option>
              </select>
            </div>
            -
            <div class="form-group col-md-3">
              <select id="inputState" class="form-control">
                <option selected>22/11/2021</option>
                <option>21/11/2021</option>
                <option>20/11/2021</option>
              </select>
            </div>
            <div class="col-md-1">
              <i class="bi bi-calendar3" style="color: #5176e0"></i>
            </div>
          </div>

          <!-- Force next columns to break to new line -->
          <div class="w-100"></div>
          xd
        </div>
        <br />
        <div class="row" style="margin-left: 5px">
          <div class="col-md-12">
          <!--Show Transactions-->
            <h5>Transactions</h5>
            <div class="content">
              <div class="table-responsive">
                <table
                  class="table table-hover table-borderless"
                  style="width: 100%"
                >
                  <!--
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Info</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                -->
                  <tbody>
                    <tr
                      v-for="transaction in transactions.slice(0, 5)"
                      :key="transaction.id"
                    >
                      <td>
                        <i
                          v-if="transaction.type == 'C'"
                          class="bi bi-arrow-bar-down label-success"
                        ></i>
                        <i v-else class="bi bi-arrow-bar-up label-danger"></i>
                      </td>
                      <td>
                        {{ transaction.payment_reference }}
                        <p class="text-secondary" style="font-size: 10px">
                          {{ transaction.datetime }}
                        </p>
                      </td>
                      <td>
                        <p
                          v-if="transaction.type == 'C'"
                          style="
                            display: inline;
                            font-weight: 700;
                            color: green;
                          "
                        >
                          + ${{
                            Math.round(
                              (transaction.new_balance -
                                transaction.old_balance) *
                                100
                            ) / 100
                          }}
                        </p>
                        <p
                          v-else
                          style="
                            display: inline;
                            font-weight: 700;
                            color: rgb(253, 53, 53);
                          "
                        >
                          - ${{
                            Math.round(
                              (transaction.new_balance -
                                transaction.old_balance) *
                                100
                            ) / 100
                          }}
                        </p>
                      </td>
                      <td>
                        <router-link
                          type="button"
                          class="btn btn-primary btn-sm"
                          :to="{
                            name: 'Transaction',
                            params: { vcard: '900000001', id: transaction.id },
                          }"
                          ><i class="bi-pencil-square" style="color: white"></i
                        ></router-link>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!--
          <div class="col-md-6">
            <h5>Transfer</h5>
            <div class="content"></div>
          </div>
          -->
        </div>
      </div>

      <div class="col-sm-5 offset-sm-2 col-md-4 offset-md-0 content-secondary">
        <!--Visual vCard-->
        <div class="secondary-info">
          <div class="row">
            <div class="col">
              <h5>My vCard</h5>
              <div class="vcard">
                <div class="logo">
                  <img src="../assets/img/logo-visa.png" alt="Visa" />
                </div>
                <div class="number">{{ vCardInfo.phone_number }}</div>
                <div class="value">${{ vCardInfo.balance }}</div>
                <div class="name">{{ vCardInfo.name }}</div>
              </div>

            </div>
          </div>
          <br />
          <br />
          <!--vCard Info-->
          <div class="card mb-3" style="max-width: 300px">
            <div class="card-header">Card Information</div>
            <div class="card-body">
              <div class="row">
                <div class="card-text col align-self-start text-secondary">
                  Status
                </div>
                <div
                  class="card-text col align-self-end text-right"
                  style="text-align: right"
                >
                  <p
                    v-if="vCardInfo.blocked == false"
                    class="label-success"
                    style="display: inline"
                  >
                    Active
                  </p>
                  <p v-else class="label-danger">Blocked</p>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="card-text col align-self-start text-secondary">
                  Name
                </div>
                <div
                  class="card-text col align-self-end"
                  style="text-align: right"
                >
                  {{ vCardInfo.name }}
                </div>
              </div>
              <br />
              <div class="card-text col align-self-start text-secondary">
                Email
              </div>
              <div
                class="card-text col align-self-end"
                style="text-align: right"
              >
                {{ vCardInfo.email }}
              </div>
              <br />
              <div class="row">
                <div class="card-text col align-self-start text-secondary">
                  Balance
                </div>
                <div
                  class="card-text col align-self-end"
                  style="text-align: right"
                >
                  ${{ vCardInfo.balance }}
                </div>
              </div>
              <br />
              <div class="row">
                <div class="card-text col align-self-start text-secondary">
                  Max debit
                </div>
                <div
                  class="card-text col align-self-end"
                  style="text-align: right"
                >
                  ${{ vCardInfo.max_debit }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Dashboard",
  prop: {},

  props: {},

  data() {
    return {
      id: 900000001,
      vCardInfo: [],
      transactions: [],
    };
  },

  methods: {
    getInfo() {
      this.$axios
        .get("vcards/" + this.id)
        .then((response) => {
          this.vCardInfo = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getTransactions() {
      this.$axios
        .get("vcards/" + this.id + "/transactions")
        .then((response) => {
          this.transactions = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getInfo();
    this.getTransactions();
  },
};
</script>

<style scoped lang="css">
@import "../assets/css/style.css";
@import "../assets/css/vcard.css";
@import "../assets/css/containers.css";

.card {
  border-radius: 25px;
}
</style>
