<template>
  <div>
    <div class="row">
      <div class="col-sm-5 col-md-8 content-primary">
        <h5 style="margin-top: 30px;">Statistics</h5>
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
                  <i class="bi bi-calendar3" style="color:#5176e0;"></i>      
                </div>
            </div>

            <!-- Force next columns to break to new line -->
            <div class="w-100"></div>
            xd
          </div>
          <br>
          <div class="row" style="margin-left:5px;">
            <div class="col-md-6">
              <h5>Transactions</h5>
              <div class="content">
                <div class="row">
                  <div class="col-md-1">
                    <i class="bi bi-arrow-bar-down text-success"></i>
                  </div>
                  <div class="col-md-7">
                    Transfer from Pepe
                    <p class="text-secondary" style="font-size: 10px;">December 10, 2021</p>
                  </div>
                  <div class="col-md-4">
                    + $10.00
                  </div>

                  <div class="col-md-1">
                    <i class="bi bi-arrow-bar-up text-danger"></i>
                  </div>
                  <div class="col-md-7">
                    Transfer from Pepe
                    <p class="text-secondary" style="font-size: 10px;">December 10, 2021</p>
                  </div>
                  <div class="col-md-4">
                    - $10.00
                  </div>
                  
                  <div class="col-md-1">
                    <i class="bi bi-arrow-bar-up text-danger"></i>
                  </div>
                  <div class="col-md-7">
                    Transfer from Pepe
                    <p class="text-secondary" style="font-size: 10px;">December 10, 2021</p>
                  </div>
                  <div class="col-md-4">
                    + $10.00
                  </div>

                  <div class="col-md-1">
                    <i class="bi bi-arrow-bar-down text-success"></i>
                  </div>
                  <div class="col-md-7">
                    Transfer from Pepe
                    <p class="text-secondary" style="font-size: 10px;">December 10, 2021</p>
                  </div>
                  <div class="col-md-4">
                    + $10.00
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <h5>Transfer</h5>
              <div class="content"></div>
            </div>
          </div>
      </div>
      
      <div class="col-sm-5 offset-sm-2 col-md-4 offset-md-0 content-secondary">
        <div class="secondary-info">
          <h5>My vCard</h5>
          <div class="vcard">
            <div class="logo"><img src="../assets/img/logo-visa.png" alt="Visa"></div>
            <div class="number"> {{ id }} </div>
            <div class="value">${{ balance }}</div>
            <div class="name">{{ name }}</div>
          </div>
          <br>
          <br>
          <div class="card mb-3" style="max-width: 300px">
            <div class="card-header">Card Information</div>
            <div class="card-body">
              <div class="row">
                  <div class="card-text col align-self-start text-secondary">Status</div>
                  <div class="card-text col align-self-end text-right" style="text-align: right; color:green;">Active</div>       
              </div>
              <br>
              <div class="row">
                  <div class="card-text col align-self-start text-secondary">Name</div>
                  <div class="card-text col align-self-end" style="text-align: right;">Simon Bolivar</div>       
              </div>
              <br>
              <div class="row">
                  <div class="card-text col align-self-start text-secondary ">Balance</div>
                  <div class="card-text col align-self-end" style="text-align: right;">$500.30</div>       
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
  name: 'Dashboard',
  prop: {
    
  },
  
  props: {

  },

  data() {
    return {
      id: 900000001,
      balance: "",
      name: "",
      transactions: [],
    };
  },

  methods: {
    getInfo() {
      this.$axios
        .get("vcards/" + this.id)
        .then((response) => {
          this.name = response.data.data.name;
          this.balance = response.data.data.balance;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getInfo();
  },
}
</script>

<style scoped lang="css">
  @import "../assets/css/vcard.css";
  @import "../assets/css/containers.css";

  .card {
    border-radius: 25px;
  }
  
</style>
