<form id="newAddrForm">
         
<div class="mymsg"></div>
          <div class="row">
            
                <input class="form-control" type="hidden" id="email" value="<?php echo $_SESSION['email'];  ?>" name="email">
                <input class="form-control" type="hidden" value="<?php error_reporting(0); echo $_SESSION['uid'];  ?>" name="user_id">
            
            <div class="col-sm-12">
              <div class="form-group">
                <label for="checkout-phone">Phone Number</label>
                <input class="form-control" type="text" id="phone" name="phone">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="checkout-company">Company<small>(Optional)</small></label>
                <input class="form-control" type="text" id="company"  name="company">
              </div>
            </div>
            
              <div class="col-sm-6">
              <div class="form-group">
                <label for="checkout-zip">ZIP Code</label>
                <input class="form-control" type="text" id="zip"name="zip" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label for="checkout-country">Country</label>
                <select class="form-control custom-select" id="mcountry" name="country">
                  <option value="">Choose country</option>
                   <?php echo getCountry(); ?>
                </select>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label for="checkout-city">State</label>
                <select id="mstates" class="form-control custom-select" name="state">
                  
                </select>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label for="checkout-city">City</label>
                <input type="text" class="form-control" name="city">
                  
                
              </div>
            </div>
          
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="checkout-address-1">Address 1</label>
                <input class="form-control" type="text" id="address1" name="address1">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="checkout-address-2">Address 2</label>
                <input class="form-control" type="text" id="address2" name="address2">
              </div>
            </div>
          </div>

        
          
          <div class="custom-control custom-checkbox mb-3">
            <input class="custom-control-input" name="default-address" value="1" type="checkbox" checked id="same-address">
            <label class="custom-control-label" for="same-address">Set as default shipping address</label>
          </div>


           <div class="modal-footer">
                  <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary btn-shadow btn-sm" id="addAddrForm" type="button">Add</button>
                </div>
         
           </form>
