<div class="modal fade" tabindex="-1" id="faqModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pertanyaan Umum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="border overflow-hidden rounded" style="border-bottom: none !important" id="faqAccordion">
                    @foreach (App\Models\Faq::all() as $faq)
                        <div class="p-3 text-success font-weight-bolder bg-light border-bottom" style="cursor: pointer" data-toggle="collapse" data-target="#faq{{ $faq->id }}">
                            {{ $faq->pertanyaan }}
                        </div>

                        <div id="faq{{ $faq->id }}" class="collapse" data-parent="#faqAccordion">
                            <div class="p-3 border-bottom">
                                {{ $faq->jawaban }}
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
