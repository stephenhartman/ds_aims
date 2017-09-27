filetype plugin indent on
set tabstop=4
set shiftwidth=4
set softtabstop=4
set nu expandtab
set number
let g:spacejam_autocmd=''
map <leader>gf :CtrlPClearAllCaches<cr> :CtrlP features_wip<cr>

"Plug for php"
call plug#begin()
Plug 'tpope/vim-dispatch' | Plug 'tpope/vim-projectionist' | Plug 'noahfrederick/vim-composer' | Plug 'noahfrederick/vim-laravel' | Plug 'jwalton512/vim-blade' | Plug 'StanAngeloff/php.vim' | Plug 'vim-syntastic/syntastic'
call plug#end()

autocmd BufNewFile,BufRead *.blade.php set ft=html | set ft=phtml | set ft=blade

function! PhpSyntaxOverride()
  hi! def link phpDocTags  phpDefine
  hi! def link phpDocParam phpType
endfunction

augroup phpSyntaxOverride
  autocmd!
  autocmd FileType php call PhpSyntaxOverride()
augroup END
