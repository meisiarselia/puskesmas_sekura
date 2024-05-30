<div class="modal fade" tabindex="-1" id="faqModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pertanyaan Umum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="faqAccordion">
                    @foreach ($faqs as $faq)
                        <div class="card">
                            <div class="card-header" id="faq{{ $faq->id }}">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button"
                                        data-toggle="collapse" data-target="#faq{{ $faq->id }}">
                                        {{ $faq->pertanyaan }}
                                    </button>
                                </h2>
                            </div>

                            <div id="faq{{ $faq->id }}" class="collapse" data-parent="#accordionExample">
                                <div class="card-body">
                                    {{ $faq->jawaban }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
