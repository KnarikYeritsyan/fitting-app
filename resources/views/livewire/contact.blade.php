<div class="input__block mt-5">
    <h3 class="input__block__title">Get started with online fitting, absolutely free</h3>
    <!--<p class="input__block__desc">Grab your copy today, exclusively from Codrops</p>-->
    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
    <input class="input__block__input" placeholder="Enter your email" wire:model="email"/>
    @error('text') <span class="text-danger">{{ $message }}</span> @enderror
    <textarea class="input__block__textarea" name="" id="" placeholder="Enter text" wire:model="text"></textarea>
    <button wire:click="send" type="button" wire:loading.attr="disabled" class="input__block__btn">CONTACT</button>
    <div wire:loading wire:target="send">

        Sending...

    </div>
</div>