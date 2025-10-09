


                                                           <form method="post" action="{{ route('password.update') }}" >
                                                           @csrf
                                                           @method('put')
															<div class="form-group">
																<label>Ancien mot de passe</label>
																<input class="form-control form-control-lg" id="current_password" name="current_password" type="password"  autocomplete="current-password" >
															</div>
															<div class="form-group">
																<label>Nouveau mot de Passe</label>
																<input class="form-control form-control-lg" id="password" name="password" type="password" autocomplete="new-password">
															</div>
															<div class="form-group">
																<label>Comfirmation Mot de Passe</label>
																<input class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" type="password"  autocomplete="new-password">
															</div>


															<div class="form-group mb-0">
																<input type="submit" class="btn btn-primary" value="Save & Update">
															</div>
                                                            </form>

