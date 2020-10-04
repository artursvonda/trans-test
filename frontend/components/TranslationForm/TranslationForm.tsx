import { Button, TextField } from '@material-ui/core';
import React, { useState } from 'react';

interface Props {
  translation: string;
  rtl: boolean;
  onSave: (newTranslation: string) => void;
  onCancel: () => void;
}

const TranslationForm = ({ translation, rtl, onCancel, onSave }: Props) => {
  const [value, setValue] = useState(translation);

  return (
    <form onSubmit={() => onSave(value)}>
      <TextField
        value={value}
        onChange={(e) => {
          setValue(e.currentTarget.value);
        }}
        fullWidth
        variant="outlined"
        dir={rtl ? 'rtl' : 'ltr'}
        autoFocus
      />
      <Button variant="contained" color="primary" type="submit">
        Save
      </Button>
      <Button variant="contained" color="default" onClick={() => onCancel()}>
        Cancel
      </Button>
    </form>
  );
};

export default TranslationForm;
