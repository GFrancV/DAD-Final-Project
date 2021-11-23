<template>
  <div>
    <div class="row">
      <div class="col-8 content-primary">
        <h3>Dashboard</h3>
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
          
          <div class="content">
            xd
          </div>
      </div>
      <div class="col-4 content-secondary">
        <h3>My vCard</h3>
        <div class="vcard">
          <div class="logo"><img src="../assets/img/logo-visa.png" alt="Visa"></div>
          
          <div class="number">1234 5678 9012 3456</div>
          <div class="name">SHOUNAK DAS</div>
          <div class="from">10/19</div>
          <div class="to">06/21</div>
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
  
  .content {
    background-color: white;
    padding: 25px;
    border: 3px 3px 3px 3px;
    border-radius: 25px;
  }

  .content-secondary {
    background-color: #edf1f7;
  }

</style>
