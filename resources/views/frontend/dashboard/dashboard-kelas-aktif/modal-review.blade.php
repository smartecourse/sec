 <!--Disabled Backdrop Modal -->
 <div class="modal fade text-left" id="kelas-review" tabindex="-1" role="dialog" aria-labelledby="review-kelas"
 aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
         <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title white" id="review-kelas">Tuliskan Review Anda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('review-kelas') }}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="text" value="{{ $kelas->id }}" hidden name="id_kelas">
                <div class="d-flex justify-content-center">
                    <div class="star-review">
                        {{-- <div class="p-2"> --}}
                            <input type="radio" id="five" name="rate" value="5">
                            <label for="five" class="material-icons" >star_rate </label>
                        {{-- </div> --}}
                        {{-- <div class="p-2"> --}}
                            <input type="radio" id="four" name="rate" value="4">
                            <label for="four" class="material-icons"> star_rate</label>
                        {{-- </div> --}}
                        {{-- <div class="p-2"> --}}
                            <input type="radio" id="three" name="rate" value="3">
                            <label for="three" class="material-icons"> star_rate</label>
                        {{-- </div> --}}
                        {{-- <div class="p-2"> --}}
                            <input type="radio" id="two" name="rate" value="2">
                            <label for="two" class="material-icons"> star_rate</label>
                        {{-- </div> --}}
                        {{-- <div class="p-2"> --}}
                            <input type="radio" id="one" name="rate" value="1">
                            <label for="one" class="material-icons"> star_rate</label>
                        {{-- </div>s --}}
                    </div>
                </div>
            </div>
            <div class="modal-body p-3">
                <div class="form-group with-title mb-3">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="ulasan" id="ulasan"></textarea>
                    <label>Ulasan Anda</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-light-secondary" data-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Batal</span>
                </button>
                <button class="btn btn-primary ml-1" type="submit">
                <i class="bx bx-check d-block d-sm-none"></i>
                <span class="d-none d-sm-block" >Simpan</span>
                </button>
            </div>
            </form>
         </div>
     </div>
 </div>
