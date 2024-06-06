<style>
/* inspired form gumroad website */
.button {
  --bg: #0000001f;
  --hover-bg: #ff90e8;
  --hover-text: #000;
  --black: #000;
  color: #000;
  cursor: pointer;
  border: 1px solid var(--bg);
  border-radius: 4px;
  padding: 0.8em 2em;
  background: var(--bg);
  transition: 0.2s;
  margin-right:10px;
}

.button:hover {
  color: var(--hover-text);
  transform: translate(-0.25rem, -0.25rem);
  background: var(--hover-bg);
  box-shadow: 0.25rem 0.25rem var(--black);
}

.button:active {
  transform: translate(0);
  box-shadow: none;
}


</style>

<a {{ $attributes->merge(['class' => 'button']) }}>
  {{ $slot }}
</a>
