import './analytics';
import { initMenu } from './menu';
import { initQuoteForm } from './quote-form';
import { initQuoteModal } from './quote-modal';

document.addEventListener('DOMContentLoaded', () => {
  initMenu();
  const contactSection = document.getElementById('contact');
  const modal = document.getElementById('quoteModalWrapper');

  initQuoteForm(contactSection);
  initQuoteModal(modal);
});