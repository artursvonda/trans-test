import { Button, Grid, makeStyles } from '@material-ui/core';
import React from 'react';
import { Translation } from './consts';
import TranslationForm from './TranslationForm';

const useStyles = makeStyles({
  container: {
    padding: '50px 0',
  },
  label: {
    width: '200px',
  },
});

interface Props {
  translation: Translation;
  isNew: boolean;
  isEditing: boolean;
  onCreate: (translation: string, language: string) => void;
  onEdit: (translation: string, language: string) => void;
  onCancel: () => void;
  onStartEditing: () => void;
  onDelete: () => void;
}

const TranslationEntry = ({
  translation,
  isEditing,
  isNew,
  onCreate,
  onEdit,
  onCancel,
  onStartEditing,
  onDelete,
}: Props) => {
  const styles = useStyles();

  const handleSave = (newTranslation: string) => {
    if (isNew) {
      onCreate(newTranslation, translation.language);
    } else {
      onEdit(newTranslation, translation.language);
    }
  };

  return (
    <Grid item xs={12} container>
      <Grid item classes={{ item: styles.label }}>
        {translation.language}
        {!isEditing && (
          <Button size="small" variant="text" onClick={onDelete}>
            x
          </Button>
        )}
      </Grid>
      <Grid item xs>
        {isEditing ? (
          <TranslationForm
            translation={translation.translation}
            rtl={translation.rtl}
            onSave={handleSave}
            onCancel={onCancel}
          />
        ) : (
          <div
            dir={translation.rtl ? 'rtl' : 'lrt'}
            onClick={() => {
              onStartEditing();
            }}
          >
            {translation.translation}
          </div>
        )}
      </Grid>
    </Grid>
  );
};

export default TranslationEntry;
