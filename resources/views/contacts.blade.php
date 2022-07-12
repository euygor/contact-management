<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerenciamento de Contatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="text-center">
            <h1>Gerenciamento de Contatos</h1>
        </div>

        <!-- Button trigger modal register -->
        <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modalRegister">
            Registrar Contato
        </button>

        @if ($success)
            <div class="alert alert-success text-center">
                {{ $success }}
            </div>
        @endif

        @if ($warning)
            <div class="alert alert-warning text-center">
                {{ $warning }}
            </div>
        @endif

        <!-- Modal Register -->
        <div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="modalLabelRegister" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabelRegister">Registrar Contato</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="register-form">
                        <div class="modal-body">
                            <div id="msg"></div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="register-name" name="name" placeholder=" " minlength="5">
                                <label for="register-name" class="col-form-label">Nome</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="register-contact" name="contact" placeholder=" " minlength="16">
                                <label for="register-contact" class="col-form-label">Contato</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="register-email" name="email" placeholder=" " minlength="8">
                                <label for="register-email" class="col-form-label">E-mail</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button id="register-submit" type="submit" class="btn btn-success">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Contato</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <th scope="row">#{{ $contact->id }}</th>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->contact }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>
                                <!-- Button trigger modal view -->
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalView{{ $contact->id }}"> Visualizar </button>

                                <!-- Modal View -->
                                <div class="modal fade" id="modalView{{ $contact->id }}" tabindex="-1" aria-labelledby="modalLabelView{{ $contact->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabelView{{ $contact->id }}">Visualizar Contato</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form class="text-start">
                                                <div class="modal-body">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="view-name" value="{{ $contact->name }}" placeholder=" " disabled>
                                                        <label for="view-name" class="col-form-label">Nome</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="view-contact" value="{{ $contact->contact }}" placeholder=" " disabled>
                                                        <label for="view-contact" class="col-form-label">Contato</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" id="view-email" value="{{ $contact->email }}" placeholder=" " disabled>
                                                        <label for="view-email" class="col-form-label">E-mail</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $contact->id }}"> Editar </button>
                                                    <a onclick="return confirm('Tem certeza que deseja excluir esse contato?')" href="{{ route('deleteContact', ['id' => $contact->id]) }}" class="btn btn-danger">Deletar</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button trigger modal edit -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $contact->id }}"> Editar </button>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="modalEdit{{ $contact->id }}" tabindex="-1" aria-labelledby="modalLabelEdit{{ $contact->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabelEdit{{ $contact->id }}">Editar Contato</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form id="edit-form{{ $contact->id }}" class="text-start">
                                                <div class="modal-body">
                                                    <div id="msg{{ $contact->id }}"></div>
                                                    <div class="form-floating mb-3">
                                                        <input type="hidden" class="form-control" id="edit-id" value="{{ $contact->id }}" name="id">
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="edit-name" value="{{ $contact->name }}" name="name" placeholder=" " minlength="5">
                                                        <label for="edit-name" class="col-form-label">Nome</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control edit-contact" id="edit-contact" value="{{ $contact->contact }}" name="contact" placeholder=" " minlength="16">
                                                        <label for="edit-contact" class="col-form-label">Contato</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" id="edit-email" value="{{ $contact->email }}" name="email" placeholder=" " minlength="8">
                                                        <label for="edit-email" class="col-form-label">E-mail</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-primary">Atualizar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <a onclick="return confirm('Tem certeza que deseja excluir esse contato?')" href="{{ route('deleteContact', ['id' => $contact->id]) }}" class="btn btn-sm btn-danger">Deletar</a>
                            </td>
                        </tr>
                        @include('helpers.ajax-edit')
                    @endforeach
                </tbody>
            </table>
            @if ($contacts->isEmpty())
                <div class="alert alert-warning text-center" role="alert">
                    Nenhum contato cadastrado!
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-center">
            {{ $contacts->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    @include('helpers.ajax-register')
</body>

</html>
