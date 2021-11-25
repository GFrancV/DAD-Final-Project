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
            <div class="number">1234 5678 9012 3456</div>
            <div class="value">$500.30</div>
            <div class="name">Simon Bolivar</div>
            <div class="from">10/19</div>
            <div class="cv">162</div>
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
}
</script>

<style scoped lang="css">
  @import "../assets/css/vcard.css";

  /*Container primary css*/
  .content-primary{
    height: 100vh;
    border-right: 1px solid rgb(233, 233, 233);
  }


  /*Container secondary css*/
  .content-secondary {
    background-color: #ecf0f7;
    height: 100vh;
  }

  .secondary-info {
    margin-top: 30px;
    margin-left: 22px;
  }

  .content {
    background-color: white;
    padding: 25px;
    border: 3px 3px 3px 3px;
    border-radius: 25px;
    margin-right: 18px;
  }

  .card {
    border-radius: 25px;
  }
  
</style>
