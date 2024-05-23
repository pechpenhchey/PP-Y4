<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 90%; width: 1200px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cartModalLabel">Your Cart</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <section class="h-100 gradient-custom" style="width: 1120px">
            <div class="container">
              <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                  <div class="card">
                    <div class="card-header py-3">
                      <h5 class="mb-0">Cart - 2 items</h5>
                    </div>
                    <div class="card-body">
                      <!-- Single item -->
                      <div class="row">
                        <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                          <!-- Image -->
                          <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Vertical/13a.webp"
                              class="w-100 h-100" />
                          </div>
                          <!-- Image -->
                        </div>
  
                        <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                          <!-- Data -->
                          <p><strong>Red hoodie</strong></p>
                          <p>Color: red</p>
                          <p>Size: M</p>
  
                          <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger mt-3 " data-mdb-tooltip-init title="Remove item">
                            <i class="fas fa-trash"></i>
                          </button>
                          <!-- Data -->
                        </div>
  
                        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                          <!-- Quantity -->
                          <div class="d-flex mb-4" style="max-width: 300px">
                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-secondary px-3 me-2"
                              onclick="this.parentNode.querySelector('input[type=number]').stepDown()" style="width: 48px; height: 40px;">
                              <i class="fas fa-minus"></i>
                            </button>
  
                            <div data-mdb-input-init class="form-outline">
                              <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control" />
                              <label class="form-label" for="form1">Quantity</label>
                            </div>
  
                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-secondary px-3 ms-2"
                              onclick="this.parentNode.querySelector('input[type=number]').stepUp()" style="width: 48px; height: 40px;">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                          <!-- Quantity -->
  
                          <!-- Price -->
                          <p class="text-start text-md-center">
                            <strong>$17.99</strong>
                          </p>
                          <!-- Price -->
                        </div>
                      </div>
                      <!-- Single item -->
                      <hr class="my-4" />
                    </div>   
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card mb-4">
                    <div class="card-header py-3">
                      <h5 class="mb-0">Summary</h5>
                    </div>
                    <div class="card-body">
                      <ul class="list-group list-group-flush">
                        <li
                          class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                          Products
                          <span>$53.98</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                          Shipping
                          <span>Gratis</span>
                        </li>
                        <li
                          class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                          <div>
                            <strong>Total amount</strong>
                            <strong>
                              <p class="mb-0">(including VAT)</p>
                            </strong>
                          </div>
                          <span><strong>$53.98</strong></span>
                        </li>
                      </ul>
  
                      <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">
                        Go to checkout
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
